<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;

class CheckForMaintenanceMode
{

    public function handle($request, Closure $next, $guard = 'admin')
    {
        if (Application::getInstance()->isDownForMaintenance() && !Auth::guard($guard)->user())
        {
            return response(view('errors.503'), 503);
        }

        return $next($request);
    }
}