<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\Regulations\CreateRegulationsRequest;
use App\Models\Regulations;
use Illuminate\Http\Request;

class RegulationsController extends BaseController
{
    private $_model;
    private $_view = 'content.regulations';

    public function __construct(Regulations $model)
    {
        parent::__construct($model, $this->_view);
        $this->_model = $model;
    }

    protected function index()
    {
        return view('Admin::' . $this->_view . '.edit', [
            'item' => $this->_model->first(),
        ]);
    }

    public function postEdit(Request $request)
    {
        $validator = \Validator::make($request->all(), with(new CreateRegulationsRequest())->rules());

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
        }

        if( !($item = $this->_model->first()) ) {
            $item = $this->_model;
        }

        $item->fill([
            'title'     => $request->get('title'),
            'content'   => $request->get('content'),
            'is_active' => $request->get('is_active') ? $request->get('is_active') : 0,
        ]);

        $item->save();

        return redirect()->route('admin.regulations.get')->with('messages', ['Update successful']);
    }
}