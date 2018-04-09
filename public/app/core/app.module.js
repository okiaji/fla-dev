(function(angular){
    'use strict'
    var app = angular.module('flaApp', ['utilApp', 'angularPagination', 'ngMaterial', 'ngMessages', 'ngCookies']);

    app.factory("httpRequestInterceptor",["$cookies", function($cookies) {

        return {
            request: function (config) {
                config.headers['FLA-TOKEN'] = $cookies.get('FLA-TOKEN');
                config.headers['roleLogin'] = localStorage.roleLogin;
                return config;
            }
        };
    }]);

    app.config(
        function ($interpolateProvider, $qProvider, $logProvider, $provide, $httpProvider) {
            $interpolateProvider.startSymbol('<{');
            $interpolateProvider.endSymbol('}>');

            $qProvider.errorOnUnhandledRejections(false);

            $logProvider.debugEnabled(false);
            $provide.decorator('$log', ['$delegate', function($delegate) {
                $delegate.warn = angular.noop;
                return $delegate;
            }]);

            $httpProvider.interceptors.push('httpRequestInterceptor');
        }
    )

})(window.angular);