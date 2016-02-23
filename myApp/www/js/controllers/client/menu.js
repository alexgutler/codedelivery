angular.module('starter.controllers')
    .controller('ClientMenuCtrl', [
        '$scope', '$state', 'User', '$ionicLoading',
        function($scope, $state, User, $ionicLoading) {
            $scope.user = {
                name: ''
            };

            $ionicLoading.show({
                template: 'Loading...'
            });

            User.authenticated({}, function(data){
                $scope.user = data.data;
                $ionicLoading.hide();
            }, function(dataError){
                $ionicLoading.hide();
            });
        }]);