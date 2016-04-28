<?php
Route::group([
    'prefix' => 'api/crm/v0.1.1',
    'middleware' => ['auth.api:api'],
    'module' => 'CRM',
    'namespace' => 'App\Modules\CRM\Http\Controllers'],
    function () {
        Route::get('/', ['uses' => 'IndexController@index']);
    }
);
