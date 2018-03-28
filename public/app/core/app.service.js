(function(angular) {
    'use strict';

    var app = angular.module('flaApp');

    // login service
    app.service('AuthService', AuthService);
    function AuthService($http) {
        return {
            login : function (input) {
                var req = $http({
                    method: "POST",
                    url: "http://127.0.0.1:8000/api/login",
                    data: input
                });

                return req;
            },

            logout : function (input) {
                var req = $http({
                    method: "POST",
                    url: "http://127.0.0.1:8000/api/logout",
                    data: input
                });

                return req;
            }
        }
    };

    // admin service
    app.service('PersonService', PersonService);
    function PersonService($http) {
        return {
            getUserListAdvance : function (input) {
                var req = $http({
                    method: "GET",
                    url: "http://127.0.0.1:8000/api/get-user-list-advance",
                    data: input
                });

                return req;
            }
        }
    };


})(window.angular);