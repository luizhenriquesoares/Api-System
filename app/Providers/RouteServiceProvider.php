<?php

namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     *
     * Geovanny L. Coutinho - Projeto Modulado
     * Não precisamos, no momento
     */
    //protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function boot(Router $router)
    {
        //

        parent::boot($router);
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function map(Router $router)
    {
        /**
         * Não precisamos, por um momento
         * Geovanny L. Coutinho - Projeto Modulado
         * Não precisamos, no momento
         */
//        $router->group(['namespace' => $this->namespace], function ($router) {
//            require app_path('Http/routes.php');
//        });
    }
}
