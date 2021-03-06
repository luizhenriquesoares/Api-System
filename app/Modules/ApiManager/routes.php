<?php

Route::group([
    'middleware' => ['web'],
    'module' => 'ApiManager',
    'namespace' => 'App\Modules\ApiManager\Http\Controllers'],
    function () {
        // Authentication Routes...
        Route::get('login', 'Auth\AuthController@showLoginForm');
        Route::post('login', 'Auth\AuthController@login');
        Route::get('logout', 'Auth\AuthController@logout');

        // Password Reset Routes...
        Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
        Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
        Route::post('password/reset', 'Auth\PasswordController@reset');

        //App Routes
        Route::get('/', ['uses' => 'IndexController@index']);
        Route::resource('/user', 'UserController');

    }
);

Route::group([
    'prefix' => 'api',
    'moduel' => 'ApiManager',
    'middleware' => ['auth.api:api'],
    'namespace' => 'App\Modules\ApiManager\Http\Controllers'],
    function () {
        Route::any('/', 'IndexController@index');
    }
);

