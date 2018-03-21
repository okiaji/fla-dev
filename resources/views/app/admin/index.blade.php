@extends('app.core.abstract')

@section('title', 'Admin')

@section('custom-style')
    <link rel="stylesheet" href="{{asset('app/view/assets/css/admin.custom.css')}}" />
@endsection

@section('custom-script')
    <script src="{{asset('app/controller/login.controller.js')}}"></script>
@endsection

@section('content')
    <div class="view" ng-view></div>
@endsection

@section('footer')
@endsection

