(function(angular){
    'use strict'
    var app = angular.module('utilApp', []);

    app.run(['$rootScope', '$window', 'AuthService', 'CommonService', 'constant',
        function ($rootScope, $window, AuthService, CommonService, constant) {
            /**
             * Daftarkan global variable/function kedalam rootscope di bawah ini
             */
            $rootScope.date = new Date();
            $rootScope.isTouchDevice = function() {
                return 'ontouchstart' in document.documentElement;
            };

            /**
             * Mendapatkan current user role
             */
            var getUserLoggedInfo = function() {
                var input = {
                }
                CommonService.getUserLoggedInfo(input)
                .then(function (result) {
                        if(result.status == constant.OK) {
                            $rootScope.currentRole = {};

                            var userInfo = result.response.userInfo;
                            $rootScope.full_name = userInfo.full_name;
                            $rootScope.currentRole.selected = result.response.currentRole;
                            $rootScope.userRoleList = result.response.userRoleList;
                            // localStorage.setItem('currentRole', result.response.role_code);
                        }

                    }
                )
                .catch(function (result) {
                        console.log(result);
                    }
                )
            }
            getUserLoggedInfo();

            $rootScope.changeRole = function(){
                console.log("current role : ", $rootScope.currentRole.selected);
            }

            $rootScope.doLogout = function () {
                var input = {
                }
                AuthService.logout(input)
                    .then(function (result) {
                            if(result.data.status == constant.OK) {
                                localStorage.clear();
                                $window.location.href = '/';
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

            $rootScope.getURLParameter = function (paramKey) {
                return decodeURIComponent(
                    (RegExp('[?|&]'+paramKey + '=' + '(.+?)(&|$)').exec(location.search)||[null,null])[1]
                );
            }

            $rootScope.setURLParameter = function (paramKey, paramValue) {
                var search;
                if($rootScope.getURLParameter(paramKey)&&$rootScope.getURLParameter(paramKey)!="null"){
                    search =location.search.replace(new RegExp('([?|&]'+paramKey + '=)' + '(.+?)(&|$)'),"$1"+encodeURIComponent(paramValue)+"$3");
                }else if(location.search.length){
                    search = location.search +'&'+paramKey + '=' +encodeURIComponent(paramValue);
                }else{
                    search = '?'+paramKey + '=' +encodeURIComponent(paramValue);
                }
                $window.history.pushState(null,document.title,search);
            }

            $rootScope.changePagination = function (page) {
                $rootScope.setURLParameter('p',page);
            }

            $rootScope.generatePagination = function (scope, Pagination, itemsPerPage, itemsCount, maxNumbers, currentPage) {
                scope.pagination = Pagination.create({
                    itemsPerPage: itemsPerPage,
                    itemsCount: itemsCount,
                    maxNumbers: maxNumbers,
                    currentPage: currentPage
                });

                scope.pagination.onChange = function(page) {

                    // must create this method on your scope
                    scope.changePagination(page);
                }
            }

            setTimeout(function(){
                var loader = document.getElementById("loader");
                if(loader!=null) {
                    loader.style.display = "none";
                }
            }, 300);

            $rootScope.showLoading = function () {
                document.getElementById("loader").style.display = "block";
                document.getElementById("loader").style.background = "#ffffff99";
            }

            $rootScope.hideLoading = function () {
                document.getElementById("loader").style.display = "none";
            }
        }
    ]);

    /**
     * Daftarkan constant di sini
     */
    app.constant(
        'constant', {
            SITE_URL: 'http://127.0.0.1:8000',
            OK: 'OK',
            FAIL: 'FAIL',
            YES: 'Y',
            NO: 'N'
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

    app.directive('pagging', function () {
        return {
            templateUrl : 'app/view/common/pagging.html'
        };
    })

    app.directive('commonModal', function () {
        return {
            templateUrl : 'app/view/common/common-modal.html'
        };
    })

    app.directive('selectWithSearch', function () {
        return {
            template : function (elem, attr) {

                var model = '',
                    theme = '',
                    title = '',
                    change = '',
                    placeholder = '',
                    label = '',
                    style = '';

                if(attr.model!=null) {
                    model = ' ng-model="'+attr.model+'.selected"';
                }
                if(attr.theme!=null) {
                    theme = ' theme="'+attr.theme+'"';
                }
                if(attr.title!=null) {
                    title = ' title="'+attr.title+'"';
                }
                if(attr.change!=null) {
                    change = ' ng-change="'+attr.change+'"';
                }
                if(attr.placeholder!=null) {
                    placeholder = ' placeholder="'+attr.placeholder+'"';
                }
                if(attr.label!=null) {
                    label = attr.label;
                }
                if(attr.style!=null) {
                    style = ' style="'+attr.style+'"';
                }

                return  '<ui-select'+model+theme+title+change+style+'>' +
                            '<ui-select-match'+placeholder+'><{$select.selected.'+label+'}></ui-select-match>' +
                            '<ui-select-choices repeat="'+attr.model+' in '+attr.list+' | filter: $select.search">' +
                                '<span ng-bind-html="'+attr.model+'.'+label+' | highlight: $select.search"></span>' +
                            '</ui-select-choices>' +
                            '<ui-select-no-choice><span>No result found</span></ui-select-no-choice>' +
                        '</ui-select>';
            }
        };
    })
})(window.angular);