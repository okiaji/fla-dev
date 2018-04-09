(function(angular) {
    'use strict';

    var app = angular.module('flaApp');
    app.controller('UsersCtrl', UsersCtrl);

    UsersCtrl.$inject = ['$scope', 'PersonService', 'constant', 'Pagination', '$mdDialog'];

    function UsersCtrl($scope, PersonService, constant, Pagination, $mdDialog) {

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

        $scope.showAdvanced = function(ev) {
            $mdDialog.show({
                controller: DialogController,
                templateUrl: 'app/view/admin/users/edit-users.html',
                parent: angular.element(document.body),
                targetEvent: ev,
                clickOutsideToClose: true,
                fullscreen: $scope.customFullscreen // Only for -xs, -sm breakpoints.
            })
        }

        $scope.showConfirm = function(ev) {
            // Appending dialog to document.body to cover sidenav in docs app
            var confirm = $mdDialog.confirm()
                .title('Are you sure?')
                .textContent('Do you want to delete selected item')
                .targetEvent(ev)
                .ok('Yes')
                .cancel('No');

            $mdDialog.show(confirm).then(function() {
                console.log("do delete");
            }, function() {
                console.log("cancel delete");
            });
        };

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

        function DialogController($scope, $mdDialog) {
            $scope.hide = function() {
                $mdDialog.hide();
            };

            $scope.cancel = function() {
                $mdDialog.cancel();
            };

            $scope.answer = function(answer) {
                $mdDialog.hide(answer);
            };
        }

    };

})(window.angular);