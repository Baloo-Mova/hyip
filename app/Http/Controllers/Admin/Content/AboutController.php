<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\About\CreateAboutRequest;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends BaseController
{
    private $_model;
    private $_view = 'content.about';

    public function __construct(About $model)
    {
        parent::__construct($model, $this->_view);
        $this->_model = $model;
    }

    public function postEdit(Request $request, $item_id = null )
    {
        $validator = \Validator::make($request->all(), with(new CreateAboutRequest())->rules());

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
        }

        if( empty($item_id) || !is_numeric($item_id) || !($item = $this->_model->find($item_id)) ) {
            $item = $this->_model;
        } else {
            $item->is_active = $request->get('is_active') ? $request->get('is_active') : 0;
        }

        if($image = $request->file('img')) {
            $origext  = $image->getClientOriginalExtension();
            $filename = generate_file_name(".{$origext}");

            \Storage::disk('uploads')->put("about/$filename", file_get_contents($image->getRealPath()));

            $item->img = $filename;
        }

        $item->fill([
            'title'     => $request->get('title'),
            'uri'       => $request->get('uri'),
            'content'   => $request->get('content'),
        ]);

        $item->save();

        return redirect()->route('admin.about-notations.get', ['id' => $item->id])->with('messages', ['Created successful']);
    }

    public function imageDelete( $item_id = null )
    {
        if( empty($item_id) || !is_numeric($item_id) || !($item = $this->_model->find($item_id)) ) {
            return response()->json([
                'success' => false,
                'message' => 'Incorrect identifier',
            ]);
        }

        if(!empty($item->img) && \Storage::disk('uploads')->exists("about/$item->img")) {
            \Storage::disk('uploads')->delete("about/$item->img");
            \Storage::disk('uploads')->delete("about/prev-$item->img");

            $item->img = '';
            $item->save();

            return response()->json([
                'success' => true,
            ]);
        }

        return response()->json([
            'success' => false,
        ]);
    }

    public function delete( $item_id = null )
    {
        if( empty($item_id) || !is_numeric($item_id) || !($item = $this->_model->find($item_id)) ) {
            return response()->json([
                'success' => false,
                'message' => 'Incorrect identifier',
            ]);
        }

        if(!empty($item->img) && \Storage::disk('uploads')->exists("about/$item->img")) {
            \Storage::disk('uploads')->delete("about/$item->img");
            \Storage::disk('uploads')->delete("about/prev-$item->img");
        }

        $item->delete();

        return redirect()->back();
    }
}