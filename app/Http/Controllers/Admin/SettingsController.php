<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;


class SettingsController extends Controller
{

    public function index()
    {
        $state = Application::getInstance()->isDownForMaintenance();
        return view("Admin::settings.index", ['state' => $state]);
    }

    public function toMaintenance()
    {
        $exitCode = Artisan::call('down');
        Session::flash("messages", ["Сайт успешно переведен в режим обслуживания!"]);
        return redirect()->route('admin.settings.index');
    }

    public function fromMaintenance()
    {
        $exitCode = Artisan::call('up');
        Session::flash("messages", ["Режим обслуживания отключен!"]);
        return redirect()->route('admin.settings.index');
    }
}
