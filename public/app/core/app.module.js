(function(angular){
    'use strict'
    var app = angular.module('flaApp', ['routeApp', 'utilApp']);

    app.config(
        function ($interpolateProvider) {
            $interpolateProvider.startSymbol('<{');
            $interpolateProvider.endSymbol('}>');
        }
    )
})(window.angular);