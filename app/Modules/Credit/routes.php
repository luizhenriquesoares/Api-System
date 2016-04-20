<?php

Route::group([
    'module' => 'Credit',
    'prefix' => 'api/credit/',
    'middleware' => ['cors','auth.api:api'],
    'namespace' => 'App\Modules\Credit\Http\Controllers'],
    function ()
    {   Route::get('/',                                                  ['uses' => 'FrontController@index'    ]);
        Route::get('/json/simplesPF/{cpf}',                              ['uses' => 'FrontController@simplesPF']);
        Route::post('/json/simplesPF/{cpf}',                             ['uses' => 'FrontController@store'    ]);
    });


