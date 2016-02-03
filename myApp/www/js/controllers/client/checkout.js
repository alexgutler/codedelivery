angular.module('starter.controllers')
    .controller('ClientCheckoutCtrl', [
        '$scope', '$state', 'cart', function($scope, $state, cart) {
            console.log(JSON.parse(window.localStorage['cart']));
            $scope.items = cart.items;
        }]);