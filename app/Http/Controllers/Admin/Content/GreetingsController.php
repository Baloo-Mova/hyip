<?php

namespace App\Http\Controllers\Admin\Content;

use App\Models\Greetings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GreetingsController extends Controller
{
    public function index()
    {
        $list = Greetings::all();
        return view('Admin::content.greetings.index', ['list' => $list]);
    }

    public function create()
    {
        return view('Admin::content.greetings.edit');
    }
}
