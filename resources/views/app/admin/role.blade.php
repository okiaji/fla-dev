@extends('app.core.admin.default')

@section('title', 'Role')

@section('custom-style')
@endsection

@section('custom-script')
<script src="{{asset('app/controller/admin/role.controller.js')}}"></script>
@endsection

@section('content')
    <div class="container-fluid" ng-controller="RoleCtrl">
        <h4 class="c-grey-900 mT-10 mB-30">Role <button type="button" class="btn cur-p btn-primary" ng-click="addDlg()">+ Add New</button></h4>
        <div class="row">
            <div class="col-md-12">
                <div class="bgc-white bd bdrs-3 p-20 mB-20 dataTables_wrapper">
                    <div class="col-md-6 p-0">
                        <form>
                            <div class="form-group row">
                                <label for="inputCode" class="col-sm-2 col-form-label">Code</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputCode" ng-model="filter.code" placeholder="Ex: ROOT">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputName" ng-model="filter.name" placeholder="Ex: Root">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputDesc" class="col-sm-2 col-form-label">Desc</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputDesc" ng-model="filter.desc" placeholder="Ex: Super Role">
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
                                    ng-options='option.value as option.name for option in showDataList'><!--http://jsfiddle.net/MTfRD/3/-->
                            </select> entries</label>
                    </div>
                    <div id="" class="dataTables_filter">
                        <label>Instant find
                            <input type="search" ng-model="search" class="instant-search" placeholder="Type anything here ..." aria-controls="dataTable">
                        </label>
                    </div>
                    <table id="gridRole" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>No.</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Active</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>No.</th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Active</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        <tr ng-repeat="role in roleList | filter:search as results">
                            <td><{$index+offset+1}>.</td>
                            <td><{role.role_code}></td>
                            <td><{role.role_name}></td>
                            <td><{role.role_desc}></td>
                            <td><{role.active=='Y'?'Yes':'No'}></td>
                            <td style="text-align: center">
                                <a class="sidebar-link" href="" ng-click="removeDlg(role)">
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
                            <td colspan="6">No result found</td>
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

