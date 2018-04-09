(function(angular) {
    'use strict';

    var app = angular.module('flaApp');
    app.controller('RoleCtrl', RoleCtrl);

    RoleCtrl.$inject = ['$scope', 'RoleService', 'constant', 'Pagination', '$mdDialog'];

    function RoleCtrl($scope, RoleService, constant, Pagination, $mdDialog) {

        var ui = $scope;

        localStorage.setItem("roleLogin", 1);

        ui.showData = ui.getURLParameter('d')!="null"?parseInt(ui.getURLParameter('d')):10;
        ui.currentPage = ui.getURLParameter('p')!="null"?ui.getURLParameter('p'):1;
        ui.filter = {};
        ui.input = {};

        ui.showDataList = [
            { name: '10', value: 10 },
            { name: '25', value: 25 },
            { name: '50', value: 50 },
            { name: '100', value: 100 }
        ];

        ui.doSearch = function () {
            var input = {
                code : ui.filter.code,
                name : ui.filter.name,
                desc : ui.filter.desc,
                limit : ui.showData,
                offset : ui.offset
            }
            RoleService.countRoleListAdvance(input)
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
            RoleService.getRoleListAdvance(input)
                .then(function (result) {
                        if(result.status == constant.OK) {
                            ui.roleList=result.response.roleList;
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

        var add = function (input) {
            $scope.showLoading();
            console.log(input);
            RoleService.addRole(input)
                .then(function (result) {
                    console.log(result);
                        if(result.status == constant.OK) {
                            ui.doSearch();
                            $scope.hideLoading();
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

        var remove = function (input) {
            $scope.showLoading();
            RoleService.removeRole(input)
                .then(function (result) {
                        console.log(result);
                        if(result.status == constant.OK) {
                            ui.doSearch();
                            $scope.hideLoading();
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

        ui.addDlg = function(ev) {
            $mdDialog.show({
                controller: DialogController,
                templateUrl: 'app/view/admin/role/add-role.html',
                parent: angular.element(document.body),
                targetEvent: ev,
                clickOutsideToClose: true
            })
        }

        ui.removeDlg = function(item) {
            // Appending dialog to document.body to cover sidenav in docs app
            var confirm = $mdDialog.confirm()
                .title('Are you sure?')
                .textContent('Do you want to delete selected item')
                .ok('Yes')
                .cancel('No');

            $mdDialog.show(confirm).then(function() {
                remove({
                    id : item.role_id
                });
            }, function() {
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

            $scope.save = function() {
                add($scope.input);
                $mdDialog.hide();
            };
        }

    };

})(window.angular);