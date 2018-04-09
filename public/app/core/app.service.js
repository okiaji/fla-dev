(function(angular) {
    'use strict';

    var app = angular.module('flaApp');

    // login service
    app.service('AuthService', AuthService);
    function AuthService($http, constant) {
        return {
            login : function (input) {
                var req = $http({
                    method: "POST",
                    url: constant.SITE_URL+"/api/login",
                    data: input
                });

                return req;
            },

            logout : function (input) {
                var req = $http({
                    method: "POST",
                    url: constant.SITE_URL+"/api/logout",
                    data: input
                });

                return req;
            }
        }
    };

    // admin service
    app.service('PersonService', PersonService);
    function PersonService($http, constant) {
        return {
            getUserListAdvance : function (input) {
                var req = $http({
                    method: "GET",
                    url: constant.SITE_URL+"/api/get-user-list-advance",
                    params: input
                });

                return req.then(function(response){
                    return response.data;
                });
            },
            countUserListAdvance : function (input) {
                var req = $http({
                    method: "GET",
                    url: constant.SITE_URL+"/api/count-user-list-advance",
                    params: input
                });

                return req.then(function(response){
                    return response.data;
                });
            }
        }
    };

    app.service('RoleService', RoleService);
    function RoleService($http, constant) {
        return {
            getRoleListAdvance : function (input) {
                var req = $http({
                    method: "GET",
                    url: constant.SITE_URL+"/api/get-role-list-advance",
                    params: input
                });

                return req.then(function(response){
                    return response.data;
                });
            },
            countRoleListAdvance : function (input) {
                var req = $http({
                    method: "GET",
                    url: constant.SITE_URL+"/api/count-role-list-advance",
                    params: input
                });

                return req.then(function(response){
                    return response.data;
                });
            },
            addRole : function (input) {
                var req = $http({
                    method: "POST",
                    url: constant.SITE_URL+"/api/add-role",
                    params: input
                });

                return req.then(function(response){
                    return response.data;
                });
            },
            removeRole : function (input) {
                var req = $http({
                    method: "POST",
                    url: constant.SITE_URL+"/api/remove-role",
                    params: input
                });

                return req.then(function(response){
                    return response.data;
                });
            }
        }
    };


})(window.angular);