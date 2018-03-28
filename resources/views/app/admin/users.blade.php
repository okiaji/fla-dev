@extends('app.core.admin.abstract')

@section('title', 'Users')

@section('custom-style')
@endsection

@section('custom-script')
<script src="{{asset('app/controller/admin/users.controller.js')}}"></script>
@endsection

@section('content')
    <div class="container-fluid" ng-controller="UsersCtrl">
        <h4 class="c-grey-900 mT-10 mB-30">Users</h4>
        <div class="row">
            <div class="col-md-12">
                <div class="bgc-white bd bdrs-3 p-20 mB-20 dataTables_wrapper">
                    <div id="" class="dataTables_filter" style="float: none">
                        <label>Full Name
                            <input type="search" ng-model="search.full_name" class="" placeholder="" aria-controls="dataTable"
                                   style="border : 1px solid #5E5E5E">
                        </label>
                    </div>
                    <div id="" class="dataTables_filter" style="float: none">
                        <label>Username
                            <input type="search" ng-model="search.username" class="" placeholder="" aria-controls="dataTable"
                                   style="border : 1px solid #5E5E5E">
                        </label>
                    </div>
                    <div id="" class="dataTables_filter" style="float: none">
                        <label>Email
                            <input type="search" ng-model="search.email" class="" placeholder="" aria-controls="dataTable"
                                   style="border : 1px solid #5E5E5E">
                        </label>
                    </div>
                    <div id="" class="dataTables_filter" style="float: none">
                        <label>Phone Number
                            <input type="search" ng-model="search.phone_number" class="" placeholder="" aria-controls="dataTable"
                                   style="border : 1px solid #5E5E5E">
                        </label>
                    </div>

                    <div class="dataTables_length" id="dataTable_length" style="float: right">
                        <label>Show
                            <select name="dataTable_length" aria-controls="dataTable" class="">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select> entries</label>
                    </div>
                    <table id="gridUser" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Action</th>
                            <th>Full Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Type</th>
                            <th>Active</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Action</th>
                            <th>Full Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Type</th>
                            <th>Active</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <tr ng-repeat="user in userList | filter:search">
                            <td>
                                <a class="sidebar-link" href="/dashboard">
                                    <span class="icon-holder">
                                        <i class="c-red-500 ti-trash"></i>
                                    </span>
                                </a>
                                <a class="sidebar-link" href="/dashboard">
                                    <span class="icon-holder">
                                        <i class="c-orange-500 ti-pencil"></i>
                                    </span>
                                </a>
                            </td>
                            <td><{user.full_name}></td>
                            <td><{user.username}></td>
                            <td><{user.email}></td>
                            <td><{user.phone_number}></td>
                            <td><{user.user_type_name}></td>
                            <td><{user.active=='Y'?'Yes':'No'}></td>
                        </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
@endsection

