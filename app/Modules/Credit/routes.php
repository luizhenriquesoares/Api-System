<?php

Route::group([
    'middleware' => ['cors'],
    'module' => 'Credit',
    'namespace' => 'App\Modules\Credit\Http\Controllers'],
    function ()
    {
        Route::get('/credit/json/simplesPF/{cpf}',                              ['uses' => 'FrontController@simplesPF']);
        Route::post('/credit/json/simplesPF/{cpf}',                             ['uses' => 'FrontController@store'    ]);
    });


