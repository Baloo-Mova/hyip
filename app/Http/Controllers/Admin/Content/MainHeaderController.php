<?php

namespace App\Http\Controllers\Admin\Content;

use App\Models\MainPage\HeaderCarousel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MainHeaderController extends Controller
{
    public function index(){
        $items = HeaderCarousel::paginate(10);
        return view('Admin::content.mainhead.index',compact('items'));
    }

    public function add(){

    }

    public function save(){

    }

    public function edit(){

    }

    public function update(){

    }

    public function delete(){

    }

}
