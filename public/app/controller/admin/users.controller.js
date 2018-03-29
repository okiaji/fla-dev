(function(angular) {
    'use strict';

    var app = angular.module('flaApp');
    app.controller('UsersCtrl', UsersCtrl);

    UsersCtrl.$inject = ['$scope', 'PersonService', 'constant', '$window'];

    function UsersCtrl($scope, PersonService, constant, $window) {

        console.log("test");

        this.doSearch = function () {
            console.log("doSearch");
            var input = {
                username : '',
                fullName : '',
                email : '',
                phoneNumber : ''
            }
            PersonService.getUserListAdvance(input)
                .then(function (result) {
                        if(result.data.status == constant.OK) {
                            console.log(result.data);
                            $scope.userList=result.data.response.userList;

                            console.log($scope.userList);
                        } else {
                            console.log(result.data);
                        }
                    }
                )
                .catch(function (result) {
                        console.log(result);
                    }
                )
        }

        this.doSearch();

    };

})(window.angular);