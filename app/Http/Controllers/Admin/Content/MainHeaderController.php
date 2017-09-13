<?php

namespace App\Http\Controllers\Admin\Content;

use App\Models\MainPage\HeaderCarousel;
use App\Models\SocialNetwork;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class MainHeaderController extends Controller
{
    public function index(){
        $items = SocialNetwork::paginate(10);
        return view('Admin::content.mainhead.index',compact('items'));
    }

    public function add(){
        return view('Admin::content.mainhead.add');
    }

    public function save(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'link' => 'required',
            'icon' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('mainheader.add'))
                ->withErrors($validator)
                ->withInput();
        }

        $item = new SocialNetwork();
        $item->name = $request->get('name');
        $item->link = $request->get('link');
        $item->icon = $request->get('icon');
        $item->save();

        Session::flash('messages', ['Изменения успешно внесены!']);
        return back();
    }

    public function edit($id){
        $item = SocialNetwork::find($id);
        if(!isset($item)){
            return redirect(route('mainheader.list'))
                ->withErrors('Записи с таким ID не существует!')
                ->withInput();
        }
        return view('Admin::content.mainhead.add', ['item' => $item]);
    }

    public function update(Request $request, $id){
        $item = SocialNetwork::find($id);
        if(!isset($item)){
            return redirect(route('mainheader.list'))
                ->withErrors('Записи с таким ID не существует!')
                ->withInput();
        }
        $item->fill($request->all());
        $item->save();
        Session::flash('messages', ['Изменения успешно внесены!']);
        return back();
    }

    public function delete($id){
        $item = SocialNetwork::find($id);
        if(!isset($item)){
            return redirect(route('mainheader.list'))
                ->withErrors('Записи с таким ID не существует!')
                ->withInput();
        }
        $item->delete();
        Session::flash('messages', ['Запись успешно удалена!']);
        return back();
    }

}
