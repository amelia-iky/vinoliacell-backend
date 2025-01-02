<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;

class Authenticate
{
    // Constructor
    protected $auth;
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    // Middleware
    public function handle($request, Closure $next, $guard = null)
    {
        if ($this->auth->guard($guard)->guest()) {
            return response('Unauthorized.', 401);
        }

        return $next($request);
    }

    // Middleware Groups
    protected $middlewareGroups = [
        'api' => [
            'throttle:api',
            \App\Http\Middleware\Authenticate::class,
        ],
    ];
}
