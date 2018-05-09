@extends('app.core.admin.default')

@section('title', 'Users')

@section('custom-style')
@endsection

@section('custom-script')
<script src="{{asset('app/controller/admin/users.controller.js')}}"></script>
@endsection

@section('content')
    <div class="container-fluid" ng-controller="UsersCtrl">
        <h4 class="c-grey-900 mT-10 mB-30">Users <button type="button" class="btn cur-p btn-primary" ng-click="openDlg('lg')">+ Add New</button></h4>
        <div class="row">
            <div class="col-md-12">
                <div class="bgc-white bd bdrs-3 p-20 mB-20 dataTables_wrapper">
                    <div class="col-md-6 p-0">
                        <form>
                            <div class="form-group row">
                                <label for="inputFullName" class="col-sm-2 col-form-label">Full Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputFullName" ng-model="filter.fullName" placeholder="Ex: Administrator">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputUsername" class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputUsername" ng-model="filter.username" placeholder="Ex: admin">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputEmail" ng-model="filter.email" placeholder="Ex: admin@mail.com">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputPhoneNumber" class="col-sm-2 col-form-label">Phone Number</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputPhoneNumber" ng-model="filter.phoneNumber" placeholder="Ex: 08xxx">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary" ng-click="doSearch()">
                                        <i class="c-white-500 ti-search"></i> Search
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="dataTables_length" id="dataTable_length">
                        <label>Show
                            <select name="dataTable_length"
                                    aria-controls="dataTable"
                                    class="bg_none"
                                    ng-model="showData"
                                    ng-change="changeShowData()"
                                    ng-options='option.value as option.name for option in showDataList'>
                            </select> entries</label>
                    </div>
                    <div id="" class="dataTables_filter">
                        <label>Instant find
                            <input type="search" ng-model="search" class="instant-search" placeholder="Type anything here ..." aria-controls="dataTable">
                        </label>
                    </div>
                    <table id="gridUser" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Full Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Type</th>
                            <th>Active</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Full Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Type</th>
                            <th>Active</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <tr ng-repeat="user in userList | filter:search as results">
                            <td><{$index+offset+1}>.</td>
                            <td><{user.full_name}></td>
                            <td><{user.username}></td>
                            <td><{user.email}></td>
                            <td><{user.phone_number}></td>
                            <td><{user.user_type_name}></td>
                            <td><{user.active=='Y'?'Yes':'No'}></td>
                            <td style="text-align: center">
                                <a class="sidebar-link" href="" ng-click="showConfirm($event)">
                                    <span class="icon-holder">
                                        <i class="c-red-500 ti-trash"></i>
                                    </span>
                                </a>
                                <a class="sidebar-link" href="" ng-click="showAdvanced($event)">
                                    <span class="icon-holder">
                                        <i class="c-orange-500 ti-pencil"></i>
                                    </span>
                                </a>
                            </td>
                        </tr>
                        <tr ng-if="results.length === 0">
                            <td colspan="8">No result found</td>
                        </tr>

                        </tbody>
                    </table>
                    <div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">Showing 1 to <{showData}> of <{count}> entries</div>
                    <div pagging></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
@endsection

