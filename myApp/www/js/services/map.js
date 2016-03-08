angular.module('starter.services')
    .factory('$map', function(){
        var key = 'user';
        return {
            center: {
                latitude: 0,
                longitude: 0
            },
            zoom: 15
        };
    });