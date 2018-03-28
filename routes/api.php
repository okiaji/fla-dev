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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/', function () {
    return redirect('/');
});
Route::post('login', 'App\Common\AuthController@login');
Route::post('logout', 'App\Common\AuthController@logout');
Route::get('get-user-list-advance', 'App\Admin\PersonController@getUserListAdvance')->middleware('verifyReq');
Route::get('test', 'TestController@test')->middleware('verifyReq');
