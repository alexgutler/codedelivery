angular.module('starter.controllers')
    .controller('ClientViewDeliveryCtrl', [
        '$scope', '$stateParams', 'ClientOrder', '$ionicLoading',
        function($scope, $stateParams, ClientOrder, $ionicLoading) {
            $scope.order = {};
            $scope.map = {
                center: {
                    latitude: -19.940025,
                    longitude: -40.602067
                },
                zoom: 16
            };
            $scope.markers = [
                {
                    id: 1,
                    coords: {
                        latitude: -19.940025,
                        longitude: -40.602067
                    },
                    options: {
                        title: "Meu título",
                        labelContent: "Meu marcador",
                        icon: "http://maps.google.com/mapfiles/kml/shapes/cabs.png"
                    }
                },
                {
                    id: 2,
                    coords: {
                        latitude: -19.920025,
                        longitude: -40.602067
                    },
                    options: {
                        title: "Meu título",
                        labelContent: "Meu marcador"
                    }
                }
            ];

            $ionicLoading.show({
                template: 'Loading...'
            });

            ClientOrder.query({id: $stateParams.id, include: 'items,cupom'}, function(data){
                $scope.order = data.data;
                $ionicLoading.hide();
            }, function(dataError){
                $ionicLoading.hide();
            });

        }]);