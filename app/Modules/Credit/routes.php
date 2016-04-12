<?php


Route::group([
    'middleware' => ['cors'],
    'module' => 'Credit',
    'namespace' => 'App\Modules\Credit\Http\Controllers'],
    function ()
    {
        Route::get('/credit/{cpf}',                              ['uses' => 'FrontController@index']);
        //Route::get('api/{cpf}', 'FrontController@index');
        Route::post('/', 'FrontController@store');
    });


