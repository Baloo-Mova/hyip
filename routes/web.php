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
    return view('index');
});

Route::get('/logout', 'AuthController@logout');

Route::group(['middleware' => 'guest'], function () {

    Route::get('/register', 'AuthController@registerForm');
    Route::post('/register', 'AuthController@register');

    Route::get('/login', 'AuthController@loginForm');
    Route::post('/login', 'AuthController@login');
});
Route::group(['middleware' => 'auth'], function () {
    Route::get('/cabinet', 'CabinetController@index');
});
