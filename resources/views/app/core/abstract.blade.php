<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @yield('custom-meta')
    <title>FLA - @yield('title')</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}" />
    @yield('custom-style')

    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>

    <script src="{{asset('js/angular.min.js')}}"></script>
    <script src="{{asset('js/angular-route.min.js')}}"></script>
    <script src="{{asset('app/core/app.route.js')}}"></script>
    <script src="{{asset('app/core/app.util.js')}}"></script>
    <script src="{{asset('app/core/app.module.js')}}"></script>
    <script src="{{asset('app/core/app.service.js')}}"></script>

    @yield('custom-script')

    <script type="text/javascript">
        angular.element(document.getElementsByTagName('head')).append(angular.element('<base href="' + window.location.pathname + '" />'));


    </script>
</head>
<body ng-app="flaApp">
    @yield('content')
    @yield('footer')
</body>
</html>
