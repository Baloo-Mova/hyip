<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Admin\BaseController;
use App\Models\MainPage\HeaderCarousel;
use Illuminate\Http\Request;

class CarouselController extends BaseController
{
    private $_model;
    private $_view = 'content.carousel';

    public function __construct(HeaderCarousel $model)
    {
        parent::__construct($model, $this->_view);
        $this->_model = $model;
    }

    public function postEdit(Request $request, $slide_id = null )
    {

        if ($request->hasFile('file')) {
            $origext  = $request->file('file')->getClientOriginalExtension();
            $filename = generate_file_name(".{$origext}");
            \Storage::disk('uploads')->put("carousel/$filename", file_get_contents($request->file('file')->getRealPath()));
        }

        $buttons = [];
        for ($i = 1; $i <= count($request->get('button_text')); $i++){
            $buttons[] = [
                'text' => $request->get('button_text')[$i],
                'url' => $request->get('url')[$i],
            ];
        }

        $carousel = HeaderCarousel::whereId($slide_id)->first();

        if(!isset($carousel)){
            $carousel = new HeaderCarousel();
        }

        $carousel->text = $request->get('text');
        $carousel->background_file = $filename;
        $carousel->need_show = $request->has('need_show') ? 1 : 0;
        $carousel->buttons = json_encode($buttons);

        $carousel->save();

        return redirect()->route('admin.carousel.add', ['id' => $carousel->id])->with('messages', ['Created successful']);
    }

}
