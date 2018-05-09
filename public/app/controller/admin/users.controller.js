(function(angular) {
    'use strict';

    var app = angular.module('flaApp');
    app.controller('UsersCtrl', UsersCtrl);

    UsersCtrl.$inject = ['$scope', 'PersonService', 'constant', 'Pagination'];

    function UsersCtrl($scope, PersonService, constant, Pagination) {

        var ui = $scope;

        ui.showData = ui.getURLParameter('d')!="null"?parseInt(ui.getURLParameter('d')):10;
        ui.currentPage = ui.getURLParameter('p')!="null"?ui.getURLParameter('p'):1;
        ui.filter = {};

        ui.showDataList = [
            { name: '1', value: 1 },
            { name: '2', value: 2 },
            { name: '10', value: 10 },
            { name: '25', value: 25 },
            { name: '50', value: 50 },
            { name: '100', value: 100 }
        ];

        ui.doSearch = function () {
            var input = {
                username : ui.filter.username,
                fullName : ui.filter.fullName,
                email : ui.filter.email,
                phoneNumber : ui.filter.phoneNumber,
                limit : ui.showData,
                offset : ui.offset
            }
            PersonService.countUserListAdvance(input)
                .then(function (result) {
                        if(result.status == constant.OK) {
                            ui.count = result.response.count;
                            ui.generatePagination(ui, Pagination, ui.showData, ui.count, 5, ui.currentPage);
                            ui.offset = ui.showData*(ui.pagination.currentPage-1);
                            getList(input);
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

        var getList = function (input) {
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

        ui.changeShowData = function () {
            ui.generatePagination(ui, Pagination, ui.showData, ui.count, 5, ui.currentPage);
            ui.setURLParameter('d',ui.showData);
            ui.offset = ui.showData*(ui.pagination.currentPage-1);
            ui.doSearch();
        }

        ui.changePagination = function(page) {
            ui.setURLParameter('p',page);
            ui.currentPage=page;
            ui.offset = ui.showData*(ui.pagination.currentPage-1);
            ui.doSearch();
        }

        ui.doSearch();

        $scope.customerinfo='sadsada';
        $scope.moreinfo= function(customer){
            console.log("test", customer);
            $scope.customerinfo= customer;

            console.log("customerinfo : ",$scope.customerinfo);
        };


    };

})(window.angular);