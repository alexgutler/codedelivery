angular.module('starter.controllers')
    .controller('DeliverymanViewOrderCtrl', [
        '$scope', '$stateParams', 'DeliverymanOrder', '$ionicLoading', '$cordovaGeolocation',
        '$ionicPopup',
        function($scope, $stateParams, DeliverymanOrder, $ionicLoading, $cordovaGeolocation, $ionicPopup) {
            var watch, lat = null, long = null;
            $scope.order = {};

            $ionicLoading.show({
                template: 'Loading...'
            });

            DeliverymanOrder.query({
                id: $stateParams.id,
                include: 'items,cupom'
            }, function(data){
                $scope.order = data.data;
                $ionicLoading.hide();
            }, function(dataError){
                $ionicLoading.hide();
            });

            $scope.goToDelivery = function(){
                $ionicPopup.alert({
                    title: 'Advertência',
                    template: 'Para parar a localização dê ok.'
                }).then(function(){
                    stopWatchPosition();
                });
                DeliverymanOrder.updateStatus({id: $stateParams.id}, {status: 1}, function(){
                    // geo localização
                    var watchOptions = {
                        timeout: 3000,
                        enableHighAccuracy: false
                    };

                    // inicializa o watcher
                    watch = $cordovaGeolocation.watchPosition(watchOptions);

                    // como é necessário repetir, a promessa não terá função de sucesso, vai trabalhar com notify
                    watch.then(null,
                        function(responseError){
                            // error
                        }, function(position) {
                            if(!lat) {
                                lat = position.coords.latitude;
                                long = position.coords.longitude;
                            } else {
                                long -= 0.0444;
                            }
                            DeliverymanOrder.geo({id: $stateParams.id}, {
                                lat: lat,
                                long: long
                            });
                        });
                });
            };

            function stopWatchPosition() {
                if(watch && typeof watch == 'object' && watch.hasOwnProperty('watchID')) {
                    $cordovaGeolocation.clearWatch(watch.watchID);
                }
            }

        }]);