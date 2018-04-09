@extends('app.core.admin.basic')

@section('title', 'Dashboard')

@section('custom-style')
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}" />
@endsection

@section('custom-script')
    <script src="{{asset('app/controller/login.controller.js')}}"></script>
@endsection

@section('content')
    <div id="loginbox" ng-controller="LoginCtrl as login">
        <form id="loginform" class="form-vertical" ng-show="login.toLogin&&!login.forggotPassword">
            <div class="control-group normal_text"> <h3><img src="http://themedesigner.in/demo/matrix-admin/img/logo.png" alt="Logo" /></h3></div>
            <div class="input-group mb-2 main_input_box">
                <div class="input-group-prepend">
                    <div class="input-group-text add-on bg_lg"><i class="fa fa-user"></i></div>
                </div>
                <input type="text" class="form-control" ng-model='login.input.username' placeholder="Username">
            </div>
            <div class="input-group mb-2 main_input_box">
                <div class="input-group-prepend">
                    <div class="input-group-text add-on bg_ly"><i class="fa fa-lock"></i></div>
                </div>
                <input id="inputPassword" type="password" class="form-control" ng-model='login.input.password' placeholder="Password">
                <div id="btnViewPass" class="view-pass <{login.btnShowPass?'show':''}>">
                    <i class="fa fa-eye-slash" aria-hidden="true"></i>
                </div>
            </div>
            <div class="form-actions">
                <span class="pull-left"><a href="" class="flip-link" id="to-recover" ng-click="login.needRecover()">Forgotten your password?</a></span>
                <span class="pull-right"><a class="btn btn-success bg_lg" href="#" ng-click="login.doLogin()" role="button">Login</a></span>
            </div>
        </form>
        <form id="recoverform" action="#" class="form-vertical" ng-show="!login.toLogin&&login.forggotPassword">
            <p class="normal_text">Enter your e-mail address below and we will send you instructions how to recover a password.</p>

            <div class="input-group mb-2 main_input_box">
                <div class="input-group-prepend">
                    <div class="input-group-text add-on bg_ly"><i class="fa fa-envelope"></i></div>
                </div>
                <input type="email" class="form-control" placeholder="E-mail address">
            </div>

            <div class="form-actions">
                <span class="pull-left"><a href="" class="flip-link" id="to-login" ng-click="login.needLogin()">Back to login?</a></span>
                <span class="pull-right"><a class="btn btn-info" href="#" role="button">Recover</a></span>
            </div>
        </form>

    </div>
    <div class="bg_db" copy-right></div>
@endsection

@section('footer')
@endsection

