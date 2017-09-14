<?php

namespace App\Http\Controllers\Admin\Content;

use App\Models\SocialNetwork;
use App\Models\SocialNetworksShares;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class SocialNetworkController extends Controller
{
    public function index(){
        $items = SocialNetwork::paginate(10);
        return view('Admin::content.social-networks.list',compact('items'));
    }

    public function shares(){
        $shares = SocialNetworksShares::find(1);
        return view('Admin::content.social-networks.shares', ['item' => $shares]);
    }

    public function sharesSave(Request $request)
    {
        $text = $request->get('text');

        $shares = [];

        foreach ($request->get('name') as $name){
            $shares[$name] = [
                'link' => str_replace(['[link]', '[text]'], [urlencode(url('/')), urlencode($text)], $request->get('link')[$name]),
                'icon' => $request->get('icon')[$name],
                'color' => $request->get('color')[$name],
                'need_show' => !empty($request->get('need_show')[$name]) ? 1 : 0,
            ];
        }

        SocialNetworksShares::where(['id' => 1])->update(['text' => $text, 'shares' => json_encode($shares)]);

        $shares = SocialNetworksShares::find(1);
        Session::flash('messages', ['Изменения успешно внесены!']);
        return view('Admin::content.social-networks.shares', ['item' => $shares]);
    }

    public function add(){
        return view('Admin::content.social-networks.edit');
    }

    public function save(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'link' => 'required',
            'icon' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.social-networks.add'))
                ->withErrors($validator)
                ->withInput();
        }

        $item = new SocialNetwork();
        $item->name = $request->get('name');
        $item->link = $request->get('link');
        $item->icon = $request->get('icon');
        $item->type_id = $request->has('type_id') ? 2 : 1;
        $item->save();

        Session::flash('messages', ['Изменения успешно внесены!']);
        return redirect()->route('admin.social-networks.get', ['id' => $item]);
    }

    public function edit($id){
        $item = SocialNetwork::find($id);
        if(!isset($item)){
            return redirect(route('admin.social-networks.list'))
                ->withErrors('Записи с таким ID не существует!')
                ->withInput();
        }
        return view('Admin::content.social-networks.edit', ['item' => $item]);
    }

    public function update(Request $request, $id){
        $item = SocialNetwork::find($id);
        if(!isset($item)){
            return redirect(route('admin.social-networks.list'))
                ->withErrors('Записи с таким ID не существует!')
                ->withInput();
        }
        $item->fill($request->all());
        $item->type_id = $request->has('type_id') ? 2 : 1;
        $item->save();
        Session::flash('messages', ['Изменения успешно внесены!']);
        return back();
    }

    public function delete($id){
        $item = SocialNetwork::find($id);
        if(!isset($item)){
            return redirect(route('admin.social-networks.list'))
                ->withErrors('Записи с таким ID не существует!')
                ->withInput();
        }
        $item->delete();
        Session::flash('messages', ['Запись успешно удалена!']);
        return back();
    }
}