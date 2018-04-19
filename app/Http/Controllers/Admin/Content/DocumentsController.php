<?php

namespace App\Http\Controllers\Admin\Content;

use App\Models\Documents;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class DocumentsController extends Controller
{
    public function index(Request $request)
    {
        $lang = $request->input('lang');
        if(!isset($lang)){
            $lang = "all";
        }
        if($lang == "all"){
            $list = Documents::paginate(15);
        }else{
            $list = Documents::where(['lang' => $lang])->paginate(15);
        }
        return view('Admin::content.documents.index', ['items' => $list,'lang' => $lang]);
    }

    public function add()
    {
        return view('Admin::content.documents.edit');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'lang' => 'required',
        ]);

        if ($validator->fails()) {
            if(!$request->has('id')){
                return redirect(route('admin.documents.add'))
                    ->withErrors($validator)
                    ->withInput();
            }else{
                return redirect(route('admin.regulations.edit', ['id' => $request->get('id')]))
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        if(!$request->has('id')){
            $document = new Documents();
        }else{
            $document = Documents::find($request->get('id'));
        }

        $document->fill($request->all());
        $document->is_active = $request->has('is_active') ? 1 : 0;
        $document->save();

        return redirect()->route('admin.documents')->with('messages', ['Изменения успешно внесены!']);

    }

    public function edit($id)
    {
        $item = Documents::findOrFail($id);
        return view('Admin::content.documents.edit', ['item' => $item]);
    }

    public function delete($id)
    {
        $item = Documents::findOrFail($id);
        $item->delete();
        return redirect()->route('admin.documents')->with('messages', ['Запись успешно удалена']);
    }
}
