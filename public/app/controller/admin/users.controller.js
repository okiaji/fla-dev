(function(angular) {
    'use strict';

    var app = angular.module('flaApp');
    app.controller('UsersCtrl', UsersCtrl);

    UsersCtrl.$inject = ['$scope', 'PersonService', 'constant', '$window', 'Pagination'];

    function UsersCtrl($scope, PersonService, constant, $window, Pagination) {

        $scope.showData=10;
        var currentPage = $scope.getURLParameter('p');
        var pagination = $scope.pagination = Pagination.create({
            itemsPerPage: 10,
            itemsCount: 100,
            maxNumbers: 5,
            currentPage: currentPage
        });

        pagination.onChange = function(page) {
            $scope.setURLParameter('p',page)
            $scope.doSearch();
        };

        $scope.doSearch = function () {
            var input = {
                username : '',
                fullName : '',
                email : '',
                phoneNumber : '',
                limit : 1,
                offset : $scope.pagination.currentPage-1
            }
            PersonService.getUserListAdvance(input)
                .then(function (result) {
                        if(result.status == constant.OK) {
                            $scope.userList=result.response.userList;
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
        $scope.changeShowData = function () {
            console.log($scope.showData);
        }


        $scope.doSearch();
        $scope.changeShowData();


    };

})(window.angular);