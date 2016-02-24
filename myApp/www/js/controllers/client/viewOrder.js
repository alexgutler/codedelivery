angular.module('starter.controllers')
    .controller('ClientViewOrderCtrl', [
        '$scope', '$stateParams', 'ClientOrder', '$ionicLoading',
        function($scope, $stateParams, ClientOrder, $ionicLoading) {
            $scope.order = {};

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