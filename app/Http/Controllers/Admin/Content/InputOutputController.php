<?php

namespace App\Http\Controllers\Admin\Content;

use App\Models\InputOutput;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class InputOutputController extends Controller
{
    public function index(Request $request)
    {
        $lang = $request->input('lang');
        if(!isset($lang)){
            $lang = "all";
        }
        if($lang == "all"){
            $list = InputOutput::paginate(15);
        }else{
            $list = InputOutput::where(['lang' => $lang])->paginate(15);
        }
        return view('Admin::content.input-output.index', ['list' => $list, 'lang' => $lang]);
    }

    public function create()
    {
        return view('Admin::content.input-output.edit');
    }

    public function edit($id)
    {
        $item = InputOutput::find($id);
        return view('Admin::content.input-output.edit', ['item' => $item]);
    }

    public function delete($id)
    {
        $item = InputOutput::find($id);
        $item->delete();
        return redirect()->route('admin.input-output.index', ['item' => $item])->with('messages', ['Изменения успешно внесены!']);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'input_title' => 'required',
            'input_text' => 'required',
            'output_title' => 'required',
            'output_text' => 'required',
            'lang' => 'required',
        ]);

        if ($validator->fails()) {
            if(!$request->has('id')){
                return redirect(route('admin.input-output.create'))
                    ->withErrors($validator)
                    ->withInput();
            }else{
                return redirect(route('admin.input-output.edit', ['id' => $request->get('id')]))
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        if(!$request->has('id')){
            $item = new InputOutput();
        }else{
            $item = InputOutput::find($request->get('id'));
        }

        $item->input_title = $request->get('input_title');
        $item->input_text = $request->get('input_text');
        $item->output_title = $request->get('output_title');
        $item->output_text = $request->get('output_text');
        $item->lang = $request->get('lang');
        $item->need_show = $request->has('need_show') ? 1 : 0;
        $item->save();

        return redirect()->route('admin.input-output.index', ['item' => $item])->with('messages', ['Изменения успешно внесены!']);

    }
}
