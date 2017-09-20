<?php

namespace App\Http\Controllers\Admin\Content;

use App\Models\MainPage\Greetings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

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

    public function edit($id)
    {
        $item = Greetings::find($id);
        return view('Admin::content.greetings.edit', ['item' => $item]);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required',
            'main_title' => 'required',
            'sub_title' => 'required',
            'description' => 'required',
            'lang' => 'required',
        ]);

        if ($validator->fails()) {
            if(!$request->has('id')){
                return redirect(route('admin.greetings.create'))
                    ->withErrors($validator)
                    ->withInput();
            }else{
                return redirect(route('admin.greetings.edit', ['id' => $request->get('id')]))
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        if(!$request->has('id')){
            $greetings = new Greetings();
        }else{
            $greetings = Greetings::find($request->get('id'));
        }

        if ($request->hasFile('image')) {
            $origext  = $request->file('image')->getClientOriginalExtension();
            $filename = generate_file_name(".{$origext}");
            \Storage::disk('uploads')->put("greetings/$filename", file_get_contents($request->file('image')->getRealPath()));
        }

        $greetings->image = isset($filename) ? $filename : $greetings->image;
        $greetings->main_title = $request->get('main_title');
        $greetings->sub_title = $request->get('sub_title');
        $greetings->description = $request->get('description');
        $greetings->lang = $request->get('lang');
        $greetings->save();

        Session::flash('messages', ['Изменения успешно внесены!']);
        return redirect()->route('admin.greetings.edit', ['item' => $greetings]);
    }

    public function deleteImg($id = null)
    {
        $item = Greetings::find($id);

        if(!isset($item)){
            return redirect(route('admin.greetings.index'))
                ->withErrors('Записи с таким ID не существует!');
        }

        \Storage::disk('uploads')->delete("greetings/$item->image");

        $item->image = null;
        $item->save();

        return redirect()->route('admin.greetings.edit', ['item' => $item]);
    }

    public function delete($id)
    {
        $item = Greetings::find($id);

        if(!isset($item)){
            return redirect(route('admin.greetings.index'))
                ->withErrors('Записи с таким ID не существует!');
        }

        \Storage::disk('uploads')->delete("greetings/$item->image");

        $item->delete();

        Session::flash('messages', ['Запись успешно удалена!']);
        return redirect()->route('admin.greetings.index');
    }
}
