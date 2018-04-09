<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    @yield('abs-header')
</head>

<body ng-app="flaApp" class="app">
@yield('abs-content')
@yield('abs-footer')
</body>

</html>