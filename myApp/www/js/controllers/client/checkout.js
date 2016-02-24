angular.module('starter.controllers')
    .controller('ClientCheckoutCtrl', [
        '$scope', '$state', '$cart', 'Order', '$ionicLoading', '$ionicPopup', 'Cupom',
        '$cordovaBarcodeScanner', 'User', '$q',
        function($scope, $state, $cart, Order, $ionicLoading, $ionicPopup, Cupom, $cordovaBarcodeScanner, User, $q) {
            User.authenticated({include: 'client'}, function(data){
                console.log(data.data);
            }, function(responseError){
                console.log("Error: " + responseError);
            });

            var cart = $cart.get();
            $scope.cupom = cart.cupom;
            $scope.items = cart.items;
            $scope.total = $cart.getTotalFinal();

            $scope.removeItem = function(i){
                $cart.removeItem(i);
                $scope.items.splice(i, 1);
                $scope.total = $cart.getTotalFinal();
            };

            $scope.openProductDetail = function(i){
                $state.go("client.checkout_item_detail", {index: i});
            };

            $scope.openListProducts = function(){
                $state.go("client.view_products");
            };

            $scope.save = function() {

                var promise = validateOrderValue();

                promise.then(function() {
                    $ionicLoading.show({
                        template:"Finalizando pedido..."
                    });

                    var o ={items: angular.copy($scope.items)};

                    angular.forEach(o.items, function(item){
                        item.product_id = item.id;
                    });

                    if($scope.cupom.value){
                        o.cupom_code = $scope.cupom.code;
                    }

                    Order.save({id: null}, o, function(data){
                        $ionicLoading.hide();
                        $state.go("client.checkout_successful");
                    }, function(responseError){
                        $ionicLoading.hide();
                        $ionicPopup.alert({
                            title: 'Advertência',
                            template: 'Erro ao finalizar o pedido. Tente novamente.'
                        });
                    });
                }, function() {
                    $ionicPopup.alert({
                        title: 'Advertência',
                        template: 'Valor do pedido inválido. É necessário adicionar mais produtos.'
                    });
                    // return false;
                });

            };

            $scope.readBarCode = function(){
                //getValueCupom('752');
                $cordovaBarcodeScanner
                    .scan()
                    .then(function(barcodeData) {
                        // Success! Barcode data is here
                        getValueCupom(barcodeData.text);
                    }, function(error) {
                        // An error occurred
                        $ionicPopup.alert({
                            title: 'Advertência',
                            template: 'Não foi possível ler o código de barras - Tente novamente.'
                        });
                    });
            };

            $scope.removeCupom = function(){
                $cart.removeCupom();
                $scope.cupom = $cart.get().cupom;
                $scope.total = $cart.getTotalFinal();
            };

            function getValueCupom(code){
                $ionicLoading.show({
                    template:"Carregando..."
                });

                Cupom.get({code: code}, function(data){
                    $cart.setCupom(data.data.code, data.data.value);
                    $scope.cupom = $cart.get().cupom;
                    $scope.total = $cart.getTotalFinal();
                    $ionicLoading.hide();
                }, function(responseError){
                    $ionicLoading.hide();
                    $ionicPopup.alert({
                        title: 'Advertência',
                        template: 'Cupom inválido.'
                    });
                });
            }

            function validateOrderValue() {
                return $q(function(resolve, reject){
                    if($cart.getTotalFinal() > 0){
                        resolve();
                    } else {
                        reject();
                    }
                })
            }

        }]);