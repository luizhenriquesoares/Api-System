<?php

namespace App\Modules\ApiManager\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticateWithApiAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (!Auth::guard($guard)->user()) {
            return response('Unauthorized.', 401);
        }

        return $next($request);
    }
}
