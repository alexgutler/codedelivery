angular.module('starter.controllers')
    .controller('ClientViewProductCtrl', [
        '$scope', '$state', 'Product', '$ionicLoading', 'cart', function($scope, $state, Product, $ionicLoading, cart) {
            window.localStorage['cart'] = JSON.stringify({
                name: "Ionic",
                version: "1.0.0"
            });
            $scope.products = [];
            $ionicLoading.show({
                template: 'Loading...'
            });
            Product.query({}, function(data){
                $scope.products = data.data;
                $ionicLoading.hide();
            }, function(dataError){
                $ionicLoading.hide();
            });

            $scope.addItem = function(p){
                cart.items.push(p);
                $state.go('client.checkout');
            };
        }]);