<?php

Route::group([
    'middleware' => ['web'],
    'module' => 'ApiManager',
    'namespace' => 'App\Modules\ApiManager\Http\Controllers'],
    function () {
        Route::auth();

        Route::get('/', ['uses' => 'IndexController@index']);
        Route::get('/users', ['uses' => 'UserController@index']);

    }
);


