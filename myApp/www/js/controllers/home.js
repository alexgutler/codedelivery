angular.module('starter.controllers', [])
    .controller('HomeCtrl', [
        '$scope', 'OAuth', '$state', '$http', '$cookies', function($scope, $http, $cookies) {

            var req = {
                method: 'GET',
                url: 'http://localhost:8000/api/authenticated',
                headers: {
                    'Authorization': $cookies.getObject('token')
                }
            };

            $http(req).then(function(response){
                $scope.username = response.data.name;
            });
    }]);