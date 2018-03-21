(function(angular) {
    'use strict';

    var app = angular.module('flaApp');
    app.controller('LoginCtrl', LoginCtrl);
    
    LoginCtrl.$inject = ['$scope', 'LoginService'];

    function LoginCtrl($scope, LoginService) {

        this.toLogin = true;
        this.forggotPassword = false;

        //determine which events to use
        var eventMouseDown = 'mousedown',
            eventMouseUp   = 'mouseup';

        if ($scope.isTouchDevice()) {
            eventMouseDown = 'touchstart';
            eventMouseUp   = 'touchend';
        }

        $( "#btnViewPass" ).bind(eventMouseDown,function() {
             $('#inputPassword').attr('type', 'text');
             $( "#btnViewPass i.fa" ).addClass("fa-eye");
             $( "#btnViewPass i.fa" ).removeClass("fa-eye-slash");
        });

        $( "#btnViewPass" ).bind(eventMouseUp,function() {
            $('#inputPassword').attr('type', 'password');
             $( "#btnViewPass i.fa" ).removeClass("fa-eye");
             $( "#btnViewPass i.fa" ).addClass("fa-eye-slash");
        });

        $("#inputPassword").keyup(function() {
            if( $(this).val().length === 0 ) {
                $("#btnViewPass").removeClass("show");
            } else {
                $("#btnViewPass").addClass("show");
            }
        });

        this.needRecover = function () {
            this.toLogin = false;
            this.forggotPassword = true;
        }
        this.needLogin = function () {
            this.toLogin = true;
            this.forggotPassword = false;
        }
    };

})(window.angular);