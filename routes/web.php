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

Route::get('/payeer_395290401.txt', function () {
    return response()->download(storage_path("1.txt"));
});

Route::get('/', "SiteController@index")->name('index');
Route::get('/about', "SiteController@about")->name('about');
Route::get('/stock', "SiteController@stock")->name('stock');
Route::get('/news', "SiteController@news")->name('news');
Route::get('/news-show/{id}', "SiteController@newsShow")->name('news.show');
Route::get('/questions', "SiteController@questions")->name('questions');
Route::get('/regulations', "SiteController@regulations")->name('regulations');
Route::get('/contacts', "SiteController@contacts")->name('contacts');
Route::get('/about-tariffs/{id}', "SiteController@tariff")->name('about.tariffs');
Route::get('/input', "SiteController@input")->name('input');
Route::get('/output', "SiteController@output")->name('output');
Route::get('/terms-of-use', "SiteController@termsOfUse")->name('terms.of.use');
Route::get('/privacy-policy', "SiteController@privacyPolicy")->name('privacy.policy');
Route::get('/file/{name}', "DownloadController@file")->name('file');
Route::get('/logout', 'AuthController@logout')->name('logout');
Route::post('/feedback/create', 'FeedbackController@create')->name('create-feedback');
Route::get('/need-verify-email', "SiteController@needVerifyEmail")->name('need.verify.email');
Route::get('/facilities/result/{type}', 'FacilitiesController@getResultRefill')->name('facilities.refill.result');
Route::post('/facilities/status', 'FacilitiesController@statusResult')->name('facilities.refill.result.post');

Route::group(['middleware' => 'guest'], function () {
    Route::group(['prefix' => 'register'], function () {

        Route::get('/', 'AuthController@registerForm')->name('register');
        Route::get('/{token}', 'AuthController@registerForm')->name('register.referral');
        Route::post('/', 'AuthController@register');

    });

    Route::group(['prefix' => 'login'], function () {
        Route::get('/', 'AuthController@loginForm')->name('login');
        Route::post('/', 'AuthController@login');
    });
});

Route::group(['middleware' => 'auth'], function () {

    Route::group(['prefix' => 'cabinet'], function () {
        Route::get('/', 'CabinetController@index')->name('cabinet');
        Route::get('/referrals', 'ReferralController@index')->name('referrals');

        Route::group(['prefix' => 'dialogs'], function () {
            Route::get('/', 'MessageController@index')->name('dialogs');
            Route::post('/create', 'MessageController@create')->name('dialogs.create');
            Route::get('{id}', 'MessageController@show')->name('dialogs.show');
        });
        Route::group(['prefix' => 'facilities'], function () {
            Route::get('/{type}', 'FacilitiesController@index')->name('facilities');
            Route::get('/operations', 'FacilitiesController@operations')->name('facilities.operations');
            Route::post('/refill', 'FacilitiesController@refill')->name('facilities.refill');
            Route::post('/refill/{type}', 'FacilitiesController@getResultRefill')->name('facilities.refill.result');
        });
        Route::group(['prefix' => 'profile'], function () {
            Route::get('/', 'ProfileController@index')->name('profile');
        });
        Route::group(['prefix' => 'tariff'], function () {
            Route::get('/', 'TariffController@index')->name('tariff');
            Route::get('{id}', 'TariffController@pay')->name('tariff.payment');
        });
        Route::group(['prefix' => 'support'], function () {
            Route::get('/', 'SupportController@index')->name('support');
        });
    });

});

Route::group([
    'middleware' => 'admin',
    'prefix' => 'admin',
    'namespace' => 'Admin'
], function () {

    Route::get('/', 'DashboardController@index')->name('admin-dashboard');

    Route::group(['prefix' => 'subscriptions'], function () {
        Route::get('/', 'SubscriptionController@index')->name('admin-subscriptions-list');
        Route::post('add', 'SubscriptionController@postAdd');
        Route::get('add', 'SubscriptionController@getAdd')->name('admin-add-subscription');
        Route::get('{id}', 'SubscriptionController@getEdit')->name('admin-get-subscription');
        Route::post('{id}', 'SubscriptionController@postEdit');
        Route::get('delete/{id}', 'SubscriptionController@delete');
    });

    Route::group(['namespace' => 'Content'], function () {
        Route::group(['prefix' => 'main-header'], function () {
            Route::get('/', 'MainHeaderController@index')->name('mainheader.list');
            Route::post('/add', 'MainHeaderController@save')->name('mainheader.add.post');
            Route::get('/add', 'MainHeaderController@add')->name('mainheader.add');
            Route::get('/edit/{id}', 'MainHeaderController@edit')->name('mainheader.edit');
            Route::post('/update/{id}', 'MainHeaderController@update')->name('mainheader.update');
            Route::get('/delete/{id}', 'MainHeaderController@delete')->name('mainheader.delete');
        });

        Route::group(['prefix' => 'social-networks'], function () {
            Route::get('/', 'SocialNetworkController@index')->name('admin.social-networks.list');
            Route::post('add', 'SocialNetworkController@postAdd');
            Route::get('add', 'SocialNetworkController@getAdd')->name('admin.social-networks.add');
            Route::get('{id}', 'SocialNetworkController@getEdit')->name('admin.social-networks.get');
            Route::post('{id}', 'SocialNetworkController@postEdit');
            Route::get('delete/{id}', 'SocialNetworkController@delete');
            Route::get('image-delete/{id}/{type}', 'SocialNetworkController@imageDelete');
        });

        Route::group(['prefix' => 'faq'], function () {
            Route::get('/', 'FAQController@index')->name('admin.faq.list');
            Route::post('add', 'FAQController@postAdd');
            Route::get('add', 'FAQController@getAdd')->name('admin.faq.add');
            Route::get('{id}', 'FAQController@getEdit')->name('admin.faq.get');
            Route::post('{id}', 'FAQController@postEdit');
            Route::get('delete/{id}', 'FAQController@delete');
        });

        Route::group(['prefix' => 'blog'], function () {
            Route::get('/', 'BlogController@index')->name('admin.articles.list');
            Route::post('add', 'BlogController@postAdd');
            Route::get('add', 'BlogController@getAdd')->name('admin.articles.add');
            Route::get('{id}', 'BlogController@getEdit')->name('admin.articles.get');
            Route::post('{id}', 'BlogController@postEdit');
            Route::get('delete/{id}', 'BlogController@delete');
            Route::get('image-delete/{id}', 'BlogController@imageDelete');
        });

        Route::group(['prefix' => 'contacts'], function () {
            Route::get('/', 'ContactController@index')->name('admin.contacts.list');
            Route::post('add', 'ContactController@postAdd');
            Route::get('add', 'ContactController@getAdd')->name('admin.contact.add');
            Route::get('{id}', 'ContactController@getEdit')->name('admin.contact.get');
            Route::post('{id}', 'ContactController@postEdit');
            Route::get('delete/{id}', 'ContactController@delete');
        });

        Route::group(['prefix' => 'about'], function () {
            Route::get('/', 'AboutController@index')->name('admin.about-notations.list');
            Route::post('add', 'AboutController@postAdd');
            Route::get('add', 'AboutController@getAdd')->name('admin.about-notations.add');
            Route::get('{id}', 'AboutController@getEdit')->name('admin.about-notations.get');
            Route::post('{id}', 'AboutController@postEdit');
            Route::get('delete/{id}', 'AboutController@delete');
            Route::get('image-delete/{id}', 'AboutController@imageDelete');
        });

        Route::group(['prefix' => 'regulations'], function () {
            Route::get('/', 'RegulationsController@index')->name('admin.regulations.get');
            Route::post('/', 'RegulationsController@postEdit');
        });
    });

    Route::group(['prefix' => 'users'], function () {
        Route::get('/', 'UserController@index')->name('admin-users-list');
    });

    Route::group(['prefix' => 'sending-messages'], function () {
        Route::get('/', 'SendingMessagesController@index')->name('admin.sending-messages');
        Route::post('/', 'SendingMessagesController@send');
    });

    Route::group(['prefix' => 'feedback'], function () {
        Route::get('{type}', 'FeedbackController@index')->name('admin-feedback-list');
        Route::get('{type}/{id}', 'FeedbackController@show')->name('admin-get-feedback');
        Route::post('{type}/{id}', 'FeedbackController@sendEmail');
    });

    Route::group(['prefix' => 'blacklist'], function () {
        Route::get('/', 'BlacklistController@index')->name('admin.blacklist');
        Route::get('{id}', 'BlacklistController@getEdit')->name('admin.blacklist.user');
        Route::post('{id}', 'BlacklistController@postEdit');
    });

});
