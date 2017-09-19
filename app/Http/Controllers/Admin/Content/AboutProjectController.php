<?php

namespace App\Http\Controllers\Admin\Content;

use App\Models\MainPage\AboutProject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutProjectController extends Controller
{
    public function index()
    {
        $list = AboutProject::all();
        return view('Admin::content.about-project.index', ['list' => $list]);
    }

    public function create()
    {
        return view('Admin::content.about-project.edit');
    }
}
