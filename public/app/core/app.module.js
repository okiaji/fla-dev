(function(angular){
    'use strict'
    var app = angular.module('flaApp', ['utilApp', 'angularPagination']);

    app.config(
        function ($interpolateProvider) {
            $interpolateProvider.startSymbol('<{');
            $interpolateProvider.endSymbol('}>');
        }
    )
})(window.angular);