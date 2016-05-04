<?php

Route::group([
    'module' => 'Credit',
    'prefix' => 'api/credit/',
    'middleware' => ['cors'],
    'namespace' => 'App\Modules\Credit\Http\Controllers'],
    function ()
    {
        Route::get('/json/localiza/{cpf}',                              ['uses' => 'ApiController@index']);
        Route::post('/json/localiza/{cpf}',                             ['uses' => 'ApiController@store']);
    });


