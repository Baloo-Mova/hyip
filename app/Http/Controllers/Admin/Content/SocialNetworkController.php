<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\SocialNetwork\CreateSocialRequest;
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

        if( empty($social_id) || !is_numeric($social_id) || !($social = $this->_model->find($social_id)) ) {
            $social = $this->_model;
        } else {
            $social->is_active = $request->get('is_active') ? $request->get('is_active') : 0;
        }

        if($image = $request->file('img')) {
            $origext  = $image->getClientOriginalExtension();
            $filename = generate_file_name(".{$origext}");

            \Storage::disk('uploads')->put("social-networks/$filename", file_get_contents($image->getRealPath()));

            $social->img = $filename;
        }

        if($image = $request->file('black_img')) {
            $origext  = $image->getClientOriginalExtension();
            $filename = generate_file_name(".{$origext}");

            \Storage::disk('uploads')->put("social-networks/$filename", file_get_contents($image->getRealPath()));

            $social->black_img = $filename;
        }

        $social->fill([
            'name'      => $request->get('name'),
            'link'      => $request->get('link'),
        ]);

        $social->save();

        return redirect()->route('admin.social-networks.get', ['id' => $social->id])->with('messages', ['Created successful']);
    }

    public function imageDelete( $social_id = null , $type = 'img')
    {
        if( empty($social_id) || !is_numeric($social_id) || !($social = $this->_model->find($social_id)) ) {
            return response()->json([
                'success' => false,
                'message' => 'Incorrect identifier',
            ]);
        }

        switch ($type) {
            case 'img':
                if(!empty($social->img) && \Storage::disk('uploads')->exists("social-networks/$social->img")) {
                    \Storage::disk('uploads')->delete("social-networks/$social->img");

                    $social->img = '';
                    $social->save();

                    return response()->json([
                        'success' => true,
                    ]);
                }
                break;
            case 'black_img':
                if(!empty($social->black_img) && \Storage::disk('uploads')->exists("social-networks/$social->black_img")) {
                    \Storage::disk('uploads')->delete("social-networks/$social->black_img");

                    $social->black_img = '';
                    $social->save();

                    return response()->json([
                        'success' => true,
                    ]);
                }
                break;
        }

        return response()->json([
            'success' => false,
        ]);
    }

    public function delete( $social_id = null )
    {
        if( empty($social_id) || !is_numeric($social_id) || !($social = $this->_model->find($social_id)) ) {
            return response()->json([
                'success' => false,
                'message' => 'Incorrect identifier',
            ]);
        }

        if(!empty($social->img) && \Storage::disk('uploads')->exists("social-networks/$social->img")) {
            \Storage::disk('uploads')->delete("social-networks/$social->img");
        }

        if(!empty($social->black_img) && \Storage::disk('uploads')->exists("social-networks/$social->black_img")) {
            \Storage::disk('uploads')->delete("social-networks/$social->black_img");
        }

        $social->delete();

        return redirect()->back();
    }
}