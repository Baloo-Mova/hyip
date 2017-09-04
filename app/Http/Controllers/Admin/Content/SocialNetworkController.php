<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\Contact\CreateSocialRequest;
use App\Models\SocialNetwork;
use Illuminate\Http\Request;

class SocialNetworkController extends BaseController
{
    private $_model;
    private $_view = 'content.social-networks';

    public function __construct(SocialNetwork $model)
    {
        parent::__construct($model, $this->_view);
        $this->_model = $model;
    }

    public function postEdit(Request $request, $social_id = null )
    {
        $validator = \Validator::make($request->all(), with(new CreateSocialRequest())->rules());

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
        }

        if( empty($social_id) || !is_numeric($social_id) || !($social = SocialNetwork::find($social_id)) ) {
            $social = new SocialNetwork();
        }

        $social->fill([
            'name'      => $request->get('name'),
            'link'      => $request->get('link'),
            'img'       => $request->get('img'),
            'black_img' => $request->get('black_img'),
        ]);

        $social->save();

        return redirect()->route('admin.social-networks.get', ['id' => $social->id])->with('messages', ['Created successful']);
    }
}