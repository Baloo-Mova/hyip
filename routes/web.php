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
    Route::group(['prefix' => 'register'], function () {

        Route::get('/', 'AuthController@registerForm');
        Route::get('{token}', 'AuthController@registerForm');
        Route::post('/', 'AuthController@register');

    });

    Route::group(['prefix' => 'login'], function () {

        Route::get('/', 'AuthController@loginForm');
        Route::post('/', 'AuthController@login');

    });
});

Route::group(['middleware' => 'auth'], function () {

    Route::group(['prefix' => 'cabinet'], function () {
        Route::get('/', 'CabinetController@index');
        Route::get('/referrals', 'ReferralController@index');

        Route::group(['prefix' => 'dialogs'], function () {
            Route::get('/', 'MessageController@index');
            Route::get('{id}', 'MessageController@show');
            Route::post('/create', 'MessageController@create');
        });
    });

});

Route::group([
    'middleware' => 'admin',
    'prefix'     => 'admin'
], function () {

    Route::get('/', function(){
        return view('Admin::index');
    });

    Route::group(['prefix' => 'blog'], function () {
        Route::get('/', 'Admin\BlogController@index');
        Route::post('add', 'Admin\BlogController@postAdd');
        Route::get('add', 'Admin\BlogController@getAdd');
        Route::get('{id}', 'Admin\BlogController@getEdit');
        Route::post('{id}', 'Admin\BlogController@postEdit');
        Route::get('delete/{id}', 'Admin\BlogController@delete');
        Route::get('image-delete/{id}', 'Admin\BlogController@imageDelete');
    });

});
