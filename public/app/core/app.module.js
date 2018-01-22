(function(angular){
    'use strict'
    var app = angular.module('pfApp', ['routeApp', 'utilApp']);

    app.config(
        function ($interpolateProvider) {
            $interpolateProvider.startSymbol('<{');
            $interpolateProvider.endSymbol('}>');
        }
    )
})(window.angular);