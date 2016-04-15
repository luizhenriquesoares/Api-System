<?php

namespace App\Modules\ApiManager;

use App\Modules\ApiManager\Http\Middleware\Authenticate;
use App\Modules\ApiManager\Http\Middleware\EncryptCookies;
use App\Modules\ApiManager\Http\Middleware\RedirectIfAuthenticated;
use App\Modules\ApiManager\Http\Middleware\VerifyCsrfToken;
use Illuminate\Foundation\Http\Kernel as HttpKernel;


class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'apiManager' => [
            EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            VerifyCsrfToken::class
        ],
        'validate' => [
            'throttle:120,1',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth.apiManager' => Authenticate::class,
        'auth.apiManager.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest.apiManager' => RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class
    ];
}
