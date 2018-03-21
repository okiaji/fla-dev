(function(angular) {
    'use strict';

    var app = angular.module('flaApp');

    // login service
    app.service('LoginService', LoginService);
    function LoginService($http) {
        return {
            login : function (input) {
                var req = $http({
                   method: "GET",
                   url: "api/"+input
                });

                return req;
            }
        }
    };

    // admin service

})(window.angular);