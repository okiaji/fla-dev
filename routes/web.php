<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('master');
});

Route::get('/login', function () {
    return view('app.admin.login');
});

Route::get('/forms', function () {
    return view('app.admin.form');
});
Route::get('/basic-table', function () {
    return view('app.admin.table');
});
Route::get('/datatable', function () {
    return view('app.admin.datatable');
});


Route::group(['middleware' => ['verifyUserLogged']], function () {

    Route::get('/', function () {
        return view('app.admin.dashboard');
    });

    Route::get('/dashboard', function () {
        return view('app.admin.dashboard');
    });

    Route::get('/users', function () {
        return view('app.admin.users');
    });

    // ROLE
    Route::get('/role', function () {
        return view('app.admin.role');
    });
});