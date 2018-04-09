@extends('app.core.admin.abstract')

@section('abs-header')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    @yield('custom-meta')
    <title>FLA - @yield('title')</title>

    <link href="{{asset('app/style/admin/css/admin.main.min.css')}}" rel="stylesheet">
    @yield('custom-style')
    <link href="{{asset('app/style/admin/css/admin.custom.css')}}" rel="stylesheet">

    <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('js/angular.min.js')}}"></script>
    <script src="{{asset('js/angular-route.min.js')}}"></script>

    <script src="{{asset('app/core/app.route.js')}}"></script>
    <script src="{{asset('app/core/app.util.js')}}"></script>
    <script src="{{asset('app/core/app.basic.module.js')}}"></script>
    <script src="{{asset('app/core/app.service.js')}}"></script>
    @yield('custom-script')
@endsection

@section('abs-content')
    @yield('content')
@endsection

@section('abs-footer')
    @yield('footer')
@endsection