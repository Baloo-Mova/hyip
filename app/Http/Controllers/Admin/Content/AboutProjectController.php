<?php

namespace App\Http\Controllers\Admin\Content;

use App\Models\MainPage\AboutProject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class AboutProjectController extends Controller
{
    public function index(Request $request)
    {
        $lang = $request->input('lang');
        if(!isset($lang)){
            $lang = "all";
        }
        if($lang == "all"){
            $list = AboutProject::paginate(15);
        }else{
            $list = AboutProject::where(['lang' => $lang])->paginate(15);
        }
        return view('Admin::content.about-project.index', ['list' => $list, 'lang' => $lang]);
    }

    public function create()
    {
        return view('Admin::content.about-project.edit');
    }

    public function edit($id)
    {
        $item = AboutProject::find($id);
        return view('Admin::content.about-project.edit', ['item' => $item]);
    }

    public function save(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'image' => 'required',
            'title' => 'required',
            'description' => 'required',
            'lang' => 'required',
        ]);

        if ($validator->fails()) {
            if(!$request->has('id')){
                return redirect(route('admin.about.project.create'))
                    ->withErrors($validator)
                    ->withInput();
            }else{
                return redirect(route('admin.about.project.edit', ['item' => $request->get('id')]))
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        if(!$request->has('id')){
            $ab = new AboutProject();
        }else{
            $ab = AboutProject::find($request->get('id'));
        }

        if ($request->hasFile('image')) {
            $origext  = $request->file('image')->getClientOriginalExtension();
            $filename = generate_file_name(".{$origext}");
            \Storage::disk('uploads')->put("aboutproject/$filename", file_get_contents($request->file('image')->getRealPath()));
        }

        $ab->image = isset($filename) ? $filename : $ab->image;
        $ab->title = $request->get('title');
        $ab->description = $request->get('description');
        $ab->lang = $request->get('lang');
        $ab->save();

        Session::flash('messages', ['Изменения успешно внесены!']);
        return redirect()->route('admin.about.project.edit', ['item' => $ab->id]);
    }

    public function deleteImg($id = null)
    {
        $item = AboutProject::find($id);

        if(!isset($item)){
            return redirect(route('admin.about.project.index'))
                ->withErrors('Записи с таким ID не существует!');
        }

        \Storage::disk('uploads')->delete("aboutproject/$item->image");

        $item->image = null;
        $item->save();

        return redirect()->route('admin.about.project.edit', ['item' => $item]);
    }

    public function delete($id)
    {
        $item = AboutProject::find($id);

        if(!isset($item)){
            return redirect(route('admin.about.project.index'))
                ->withErrors('Записи с таким ID не существует!');
        }

        \Storage::disk('uploads')->delete("aboutproject/$item->image");

        $item->delete();

        Session::flash('messages', ['Запись успешно удалена!']);
        return redirect()->route('admin.about.project.index');
    }
}
