<?php

namespace App\Http\Controllers\Admin;

use App\Models\UsersPageSettings;
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

    public function users()
    {
        $levels = UsersPageSettings::orderBy('value', 'asc')->get();

        return view("Admin::settings.users", ['levels' => isset($levels) ? $levels : []]);
    }

    public function usersSave(Request $request)
    {
        if(!$request->has('value')){
            return redirect(route('admin.settings.users'))
                ->withErrors(['Вы не указали значение!']);
        }

        UsersPageSettings::insert([
            'value' => $request->get('value')
        ]);

        Session::flash('messages', ['Данные успешно внесены']);
        return redirect(route('admin.settings.users'));
    }

    public function usersLevelDelete($id)
    {
        $level = UsersPageSettings::find($id);
        if(!isset($level)){
            return redirect(route('admin.settings.users'))
                ->withErrors(['такого уровня нет!']);
        }

        $level->delete();
        Session::flash('messages', ['Запись успешно удалена']);
        return redirect(route('admin.settings.users'));
    }
}
