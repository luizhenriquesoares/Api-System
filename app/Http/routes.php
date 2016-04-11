<?php


Route::get('/cpf', function(){
    return "teste";
});

Route::group(['middleware' => ['cors']], function () {
    Route::get('api/{cpf}',  'FrontController@index');
    Route::post('/',         'FrontController@store');
});


