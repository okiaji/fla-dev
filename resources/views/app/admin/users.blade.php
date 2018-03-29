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

                    <div class="dataTables_length" id="dataTable_length">
                        <label>Show
                            <select name="dataTable_length"
                                    aria-controls="dataTable"
                                    class=""
                                    ng-model="showData"
                                    ng-change="changeShowData()"><!--http://jsfiddle.net/MTfRD/3/-->
                                <option value="10" selected>10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select> entries</label>
                    </div>
                    <div id="" class="dataTables_filter">
                        <label>Instant find
                            <input type="search" ng-model="search" class="" placeholder="" aria-controls="dataTable"
                                   style="border : 1px solid #5E5E5E">
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
                        <tr ng-repeat="user in userList | filter:search">
                            <td><{$index+1}>.</td>
                            <td><{user.full_name}></td>
                            <td><{user.username}></td>
                            <td><{user.email}></td>
                            <td><{user.phone_number}></td>
                            <td><{user.user_type_name}></td>
                            <td><{user.active=='Y'?'Yes':'No'}></td>
                            <td style="text-align: center">
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
                        </tr>
                        <tr ng-if="results.length === 0">
                            <td colspan="8">No result found</td>
                        </tr>

                        </tbody>
                    </table>
                    <div pagging></div>
                    <div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div>
                    <div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
                        <a class="paginate_button previous disabled" aria-controls="dataTable" data-dt-idx="0" tabindex="0" id="dataTable_previous">Previous</a>
                        <span>
                            <a class="paginate_button current" aria-controls="dataTable" data-dt-idx="1" tabindex="0">1</a>
                            <a class="paginate_button " aria-controls="dataTable" data-dt-idx="2" tabindex="0">2</a>
                            <a class="paginate_button " aria-controls="dataTable" data-dt-idx="3" tabindex="0">3</a>
                            <a class="paginate_button " aria-controls="dataTable" data-dt-idx="4" tabindex="0">4</a>
                            <a class="paginate_button " aria-controls="dataTable" data-dt-idx="5" tabindex="0">5</a>
                            <a class="paginate_button " aria-controls="dataTable" data-dt-idx="6" tabindex="0">6</a>
                        </span>
                        <a class="btn cur-p btn-outline-primary next" aria-controls="dataTable" data-dt-idx="7" tabindex="0" id="dataTable_next">Next</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
@endsection

