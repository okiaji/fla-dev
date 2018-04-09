(function(angular){
    'use strict'
    var app = angular.module('utilApp', []);

    app.run(['$rootScope', '$window', 'AuthService', 'constant',
        function ($rootScope, $window, AuthService, constant) {
            /**
             * Daftarkan global variable/function kedalam rootscope di bawah ini
             */
            $rootScope.date = new Date();
            $rootScope.isTouchDevice = function() {
                return 'ontouchstart' in document.documentElement;
            };

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
                document.getElementById("loader").style.display = "none";
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
})(window.angular);