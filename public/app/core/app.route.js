(function(angular){
    'use strict'
    var app = angular.module('routeApp', ['ngRoute']);

    app.config(
        function ($routeProvider, $locationProvider) {
            $routeProvider.otherwise('/login');
            $routeProvider.when('/login', {
                templateUrl : 'app/view/admin/login/signin.html',
                controller : 'LoginCtrl',
                controllerAs : 'login'
            });

            $routeProvider.when('/admin', {
                templateUrl : 'app/view/admin/dashboard/index.html',
                controller : 'DashboardCtrl',
                controllerAs : 'dashboard'
            });

            $locationProvider.html5Mode(false);
        }
    )
})(window.angular);