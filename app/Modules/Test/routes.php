<?php

Route::group([
    'module'    => 'Test',
    'namespace' => 'App\Modules\Test'],
    function ()
    {
        Route::get('/json/localize/{cpf}',                              ['uses' => 'Credit\Http\Controllers\FrontController@index']);
        Route::post('/json/localize/{cpf}',                             ['uses' => 'Credit\Http\Controllers\FrontController@store']);
    });


