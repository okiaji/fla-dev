(function(angular) {
    'use strict';

    angular.module('pfApp')
        .controller('LoginCtrl', LoginCtrl)
    LoginCtrl.$inject = ['$route', '$routeParams', '$location', 'LoginService']

    function LoginCtrl($route, $routeParams, $location, OfficeService) {
        this.tabActive = "login";

        this.needAccount = function () {
            this.tabActive = "register";
        }
        this.selectAccount = function () {
            this.tabActive = "select";
        }
        this.haveAccount = function () {
            this.tabActive = "login";
        }
    };

})(window.angular);