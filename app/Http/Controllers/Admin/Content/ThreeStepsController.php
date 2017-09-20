<?php

namespace App\Http\Controllers\Admin\Content;

use App\Models\MainPage\ThreeSteps;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class ThreeStepsController extends Controller
{
    public function index(Request $request)
    {
        $lang = $request->input('lang');
        if(!isset($lang)){
            $lang = "all";
        }
        if($lang == "all"){
            $list = ThreeSteps::paginate(15);
        }else{
            $list = ThreeSteps::where(['lang' => $lang])->paginate(15);
        }
        return view('Admin::content.three-steps.index', ['list' => $list, 'lang' => $lang]);
    }

    public function create()
    {
        return view('Admin::content.three-steps.edit');
    }

    public function edit($id)
    {
        $item = ThreeSteps::find($id);
        return view('Admin::content.three-steps.edit', ['item' => $item]);
    }

    public function delete($id)
    {
        $item = ThreeSteps::find($id);
        $item->delete();
        Session::flash('messages', ['Запись успешно удалена!']);
        return redirect()->route('admin.three-steps.index');
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'main_title' => 'required',
            'first_title' => 'required',
            'first_text' => 'required',
            'second_title' => 'required',
            'second_text' => 'required',
            'third_title' => 'required',
            'third_text' => 'required',
            'lang' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.three-steps.index'))
                ->withErrors($validator)
                ->withInput();
        }

        $text = ThreeSteps::find(1);

        if(!isset($text)){
            $text = new ThreeSteps();
        }

        $text->main_title = $request->get('main_title');
        $text->first_title = $request->get('first_title');
        $text->first_text = $request->get('first_text');
        $text->second_title = $request->get('second_title');
        $text->second_text = $request->get('second_text');
        $text->third_title = $request->get('third_title');
        $text->third_text = $request->get('third_text');
        $text->lang = $request->get('lang');
        $text->save();

        Session::flash('messages', ['Изменения успешно внесены!']);
        return redirect()->route('admin.three-steps.index', ['item' => $text]);
    }
}
