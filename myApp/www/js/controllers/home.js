angular.module('HomeCtrl', [])
    .controller('HomeCtrl', [
        '$scope', '$http', function($scope, $http) {
            $http({
                method: 'GET',
                url: 'http://localhost:8000/api/authenticated'
            }).then(function(response){
                console.log(response);
                $scope.username = response.data.data.name;
            }, function(response){
                console.log("Não foi possível obter o usuário logado. \n" + response);
            });
        }]);