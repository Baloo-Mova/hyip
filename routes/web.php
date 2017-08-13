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
        Route::get('/', 'CabinetController@index')->name('cabinet');
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
        return Redirect()->route('admin-dashboard');
    });
    Route::get('/dashboard', 'Admin\DashboardController@index')->name('admin-dashboard');

    Route::group(['prefix' => 'blog'], function () {
        Route::get('/', 'Admin\BlogController@index')->name('admin-blog-list');
        Route::post('add', 'Admin\BlogController@postAdd');
        Route::get('add', 'Admin\BlogController@getAdd')->name('admin-get-add-article');
        Route::get('{id}', 'Admin\BlogController@getEdit')->name('admin-get-single-article');
        Route::post('{id}', 'Admin\BlogController@postEdit');
        Route::get('delete/{id}', 'Admin\BlogController@delete');
        Route::get('image-delete/{id}', 'Admin\BlogController@imageDelete');
    });

    Route::group(['prefix' => 'contacts'], function () {
        Route::get('/', 'Admin\ContactController@index')->name('admin-contacts-list');
        Route::post('add', 'Admin\ContactController@postAdd');
        Route::get('add', 'Admin\ContactController@getAdd')->name('admin-add-contact');
        Route::get('{id}', 'Admin\ContactController@getEdit')->name('admin-get-contact');
        Route::post('{id}', 'Admin\ContactController@postEdit');
        Route::get('delete/{id}', 'Admin\ContactController@delete');
    });

    Route::group(['prefix' => 'subscription'], function () {
        Route::get('/', 'Admin\SubscriptionController@index')->name('admin-subscriptions-list');
        Route::post('add', 'Admin\SubscriptionController@postAdd');
        Route::get('add', 'Admin\SubscriptionController@getAdd')->name('admin-add-subscription');
        Route::get('{id}', 'Admin\SubscriptionController@getEdit')->name('admin-get-subscription');
        Route::post('{id}', 'Admin\SubscriptionController@postEdit');
        Route::get('delete/{id}', 'Admin\SubscriptionController@delete');
    });

});
