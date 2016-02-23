angular.module('starter.controllers')
    .controller('ClientCheckoutDetailCtrl', [
        '$scope', '$state', '$cart', '$stateParams', function($scope, $state, $cart, $stateParams) {

            $scope.product = $cart.getItem($stateParams.index);
            $scope.updateQtd = function(){
                if(!isNaN($scope.product.qtd)) {
                    $cart.updateQtd($stateParams.index, $scope.product.qtd);
                    $state.go("client.checkout");
                }
            }

        }]);