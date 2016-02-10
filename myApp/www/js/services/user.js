angular.module('starter.services')
    .factory('User', ['$resource', 'appConfig', function($resource, appConfig) {

        return $resource(appConfig.baseUrl + "/api/authenticated", {}, {
            query: {
                isArray: false
            },
            authenticated: {
                http: "GET",
                url: appConfig.baseUrl + "/api/authenticated"
            }
        });

    }]);