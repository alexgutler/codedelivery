angular.module('starter.controllers')
    .controller('DeliverymanMenuCtrl', ['$scope', 'UserData', function($scope, UserData) {
            $scope.user = UserData.get();
        }]);