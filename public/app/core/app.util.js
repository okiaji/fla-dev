(function(angular){
    'use strict'
    var app = angular.module('utilApp', []);

    app.run(
        function ($rootScope) {
            $rootScope.date = new Date();
        }
    );

    app.directive('copyRight', function () {
        return {
            templateUrl : 'app/view/common/copy.html'
        };
    })
})(window.angular);