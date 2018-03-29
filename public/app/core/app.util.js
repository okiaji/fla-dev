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
                console.log("logout");
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
                if($rootScope.getURLParameter(paramKey)){
                    search =location.search.replace(new RegExp('([?|&]'+paramKey + '=)' + '(.+?)(&|$)'),"$1"+encodeURIComponent(paramValue)+"$3");
                }else if(location.search.length){
                    search = location.search +'&'+paramKey + '=' +encodeURIComponent(paramValue);
                }else{
                    search = '?'+paramKey + '=' +encodeURIComponent(paramValue);
                }
                $window.history.pushState(null,document.title,search);
            }
        }
    ]);

    /**
     * Daftarkan constant di sini
     */
    app.constant(
        'constant', {
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