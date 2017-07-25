<?php

namespace App\Http\Middleware;

use Closure, Auth;

class Users
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'users')
    {
        if (!Auth::guard($guard)->check()) {
            return redirect('/login');
        }

        return $next($request);
    }
}
