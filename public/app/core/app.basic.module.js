(function(angular){
    'use strict'
    var app = angular.module('flaApp', ['routeApp','utilApp']);

    app.config(
        function ($interpolateProvider, $qProvider, $logProvider, $provide) {
            $interpolateProvider.startSymbol('<{');
            $interpolateProvider.endSymbol('}>');

            $qProvider.errorOnUnhandledRejections(false);

            $logProvider.debugEnabled(false);
            $provide.decorator('$log', ['$delegate', function($delegate) {
                $delegate.warn = angular.noop;
                return $delegate;
            }]);
        }
    )
})(window.angular);