(function(angular){
    'use strict'
    var app = angular.module('utilApp', []);

    app.run(
        function ($rootScope) {
            /**
             * Daftarkan global variable/function kedalam rootscope di bawah ini
             */
            $rootScope.date = new Date();
            $rootScope.isTouchDevice = function() {
                return 'ontouchstart' in document.documentElement;
            };
        }
    );

    /**
     * Directive template copyRigth,
     * Anda cukup memanggil copy.html dengan hanya menyebut
     * <div copy-right></div> diHTML anda
     */
    app.directive('copyRight', function () {
        return {
            templateUrl : 'app/view/common/copy.html'
        };
    })
})(window.angular);