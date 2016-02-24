angular.module('starter.controllers')
    .controller('ClientMenuCtrl', ['$scope', 'UserData', function($scope, UserData) {
            $scope.user = UserData.get();
        }]);