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
    return view('app.admin.index');
});

Route::get('/', function () {
    return view('app.admin.dashboard');
})->middleware('verifyReq');
Route::get('/dashboard', function () {
    return view('app.admin.dashboard');
})->middleware('verifyReq');
Route::get('/forms', function () {
    return view('app.admin.form');
});
Route::get('/basic-table', function () {
    return view('app.admin.table');
});
Route::get('/datatable', function () {
    return view('app.admin.datatable');
});
Route::get('/users', function () {
    return view('app.admin.users');
});