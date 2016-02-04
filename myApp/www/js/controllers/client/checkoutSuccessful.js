angular.module('starter.controllers')
    .controller('ClientCheckoutSuccessfulCtrl', [
        '$scope', '$state', '$cart', function($scope, $state, $cart) {
            var cart = $cart.get();
            $scope.items = cart.items;
            $scope.total = cart.total;
            $cart.clear();

            $scope.openListOrders = function(){

            };
        }]);