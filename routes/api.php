<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('test', 'TestController@test')->middleware('verifyReq');

Route::post('login', 'App\Common\AuthController@login');
Route::post('logout', 'App\Common\AuthController@logout');

Route::group(['middleware' => ['verifyReq']], function () {

    // ROLE
    Route::post('add-role', 'App\Admin\RoleController@addRole');
    Route::post('edit-role', 'App\Admin\RoleController@editRole');
    Route::post('remove-role', 'App\Admin\RoleController@removeRole');
    Route::get('get-role-list-advance', 'App\Admin\RoleController@getRoleListAdvance');
    Route::get('count-role-list-advance', 'App\Admin\RoleController@countRoleListAdvance');

    // ROLE & TASK
    Route::post('mapping-role-task', 'App\Admin\RoleTaskController@mappingRoleTask');
    Route::post('unmapping-role-task', 'App\Admin\RoleTaskController@unmappingRoleTask');
    Route::get('get-task-list-advance', 'App\Admin\RoleTaskController@getTaskListAdvance');
    Route::get('count-task-list-advance', 'App\Admin\RoleTaskController@countTaskListAdvance');
    Route::get('get-role-task-list-advance', 'App\Admin\RoleTaskController@getRoleTaskListAdvance');
    Route::get('count-role-task-list-advance', 'App\Admin\RoleTaskController@countRoleTaskListAdvance');

    // USER
    Route::post('add-user', 'App\Admin\PersonController@addUser');
    Route::post('edit-user', 'App\Admin\PersonController@editUser');
    Route::post('remove-user', 'App\Admin\PersonController@removeUser');
    Route::get('get-user-list-advance', 'App\Admin\PersonController@getUserListAdvance');
    Route::get('count-user-list-advance', 'App\Admin\PersonController@countUserListAdvance');

});
