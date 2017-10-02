<?php

namespace App\Http\Middleware;

use App\Models\Settings;
use Closure;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;

class CheckForMaintenanceMode
{

    public function handle($request, Closure $next, $guard = 'admin')
    {
        $settings = Settings::find(1);
        $ips = json_decode($settings->admin_ips);
        if (Application::getInstance()->isDownForMaintenance() && !in_array($request->ip(), $ips)) {
            return response(view('errors.503'), 503);
        }

        return $next($request);
    }
}