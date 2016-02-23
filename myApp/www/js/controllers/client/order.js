angular.module('starter.controllers')
    .controller('ClientOrderCtrl', [
        '$scope', '$state', 'Order', '$ionicLoading',
        function($scope, $state, Order, $ionicLoading) {
            $scope.items = [];

            $ionicLoading.show({
                template: 'Loading...'
            });

            //refresher
            $scope.doRefresh = function(){
                getOrders().then(function(data){
                    $scope.items = data.data;
                    $scope.$broadcast('scroll.refreshComplete');
                }, function(dataError){
                    $scope.$broadcast('scroll.refreshComplete');
                });
            };

            $scope.openOrderDetail = function(order){
                $state.go("client.view_order", {id: order.id});
            };

            function getOrders(){
                return Order.query({
                    id: null,
                    orderBy: 'created_at',
                    sortedBy: 'desc'
                }).$promise;
            }

            getOrders().then(function(data){
                $scope.items = data.data;
                $ionicLoading.hide();
            }, function(dataError){
                $ionicLoading.hide();
            });
        }]);