<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\Regulations\CreateRegulationsRequest;
use App\Models\Regulations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class RegulationsController extends BaseController
{
    private $_model;
    private $_view = 'content.regulations';

    public function __construct(Regulations $model)
    {
        parent::__construct($model, $this->_view);
        $this->_model = $model;
    }

    public function indexList(Request $request)
    {
        $lang = $request->input('lang');
        if(!isset($lang)){
            $lang = "all";
        }
        if($lang == "all"){
            $list = Regulations::paginate(15);
        }else{
            $list = Regulations::where(['lang' => $lang])->paginate(15);
        }
        return view('Admin::content.regulations.list', ['items' => $list,'lang' => $lang]);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'lang' => 'required',
        ]);

        if ($validator->fails()) {
            if(!$request->has('id')){
                return redirect(route('admin.regulations.create'))
                    ->withErrors($validator)
                    ->withInput();
            }else{
                return redirect(route('admin.regulations.edit', ['id' => $request->get('id')]))
                    ->withErrors($validator)
                    ->withInput();
            }
        }

        if(!$request->has('id')){
            $item = new Regulations();
        }else{
            $item = Regulations::find($request->get('id'));
        }

        $item->title = $request->get('title');
        $item->content = $request->get('content');
        $item->is_active = $request->has('is_active') ? 1 : 0;
        $item->lang = $request->get('lang');
        $item->save();

        return redirect()->route('admin.regulations.list', ['item' => $item])->with('messages', ['Изменения успешно внесены!']);

    }
}