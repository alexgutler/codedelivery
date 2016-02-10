angular.module('starter.controllers')
    .controller('ClientViewOrderCtrl', [
        '$scope', '$stateParams', 'Order', '$ionicLoading',
        function($scope, $stateParams, Order, $ionicLoading) {
            $scope.order = {};

            $ionicLoading.show({
                template: 'Loading...'
            });

            Order.query({
                id: $stateParams.id,
                include: 'items,cupom'
            }, function(data){
                $scope.order = data.data;
                $ionicLoading.hide();
            }, function(dataError){
                $ionicLoading.hide();
            });

        }]);