angular.module('starter.controllers')
    .controller('ClientOrderCtrl', [
        '$scope', '$state', 'ClientOrder', '$ionicLoading', '$ionicActionSheet',
        function($scope, $state, ClientOrder, $ionicLoading, $ionicActionSheet) {
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

            $scope.showActionSheet = function(order){
                $ionicActionSheet.show({
                    buttons: [
                        {text: 'Ver Detalhes'},
                        {text: 'Ver Entrega'}
                    ],
                    titleText: 'Opções:',
                    cancelText: 'Cancelar',
                    cancel: function(){
                        // fazer alguma coisa no cancelamento
                    },
                    buttonClicked: function(index){
                        switch (index){
                            case 0:
                                $state.go("client.view_order", {id: order.id});
                                break;
                            case 1:
                                $state.go("client.view_delivery", {id: order.id});
                                break;
                        }
                    }
                });
            };

            function getOrders(){
                return ClientOrder.query({
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