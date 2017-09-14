<?php

namespace App\Http\Controllers\Admin\Content;

use App\Models\InputOutput;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class InputOutputController extends Controller
{
    public function index()
    {
        $item = InputOutput::find(1);
        return view('Admin::content.input-output.edit', ['item' => isset($item) ? $item : ""]);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'input_title' => 'required',
            'input_text' => 'required',
            'output_title' => 'required',
            'output_text' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.input-output.index'))
                ->withErrors($validator)
                ->withInput();
        }

        $item = InputOutput::find(1);

        if(!isset($item)){
            $item = new InputOutput();
        }

        $item->input_title = $request->get('input_title');
        $item->input_text = $request->get('input_text');
        $item->output_title = $request->get('output_title');
        $item->output_text = $request->get('output_text');
        $item->need_show = $request->has('need_show') ? 1 : 0;
        $item->save();

        return redirect()->route('admin.input-output.index', ['item' => $item])->with('messages', ['Изменения успешно внесены!']);

    }
}
