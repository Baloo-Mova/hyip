<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Admin\BaseController;
use App\Models\MainPage\HeaderCarousel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CarouselController extends BaseController
{
    private $_model;
    private $_view = 'content.carousel';

    public function __construct(HeaderCarousel $model)
    {
        parent::__construct($model, $this->_view);
        $this->_model = $model;
    }

    public function getAdd()
    {
        return view('Admin::content.carousel.edit');
    }

    public function postEdit(Request $request, $slide_id = null )
    {
        $carousel = HeaderCarousel::find($slide_id);
        $validator = Validator::make($request->all(), [
            'text' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect(route('admin.carousel.add'))
                ->withErrors($validator)
                ->withInput();
        }

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

        if(!isset($carousel)){
            $carousel = new HeaderCarousel();
        }

        $carousel->text = $request->get('text');
        $carousel->background_file = isset($filename) ? $filename : $request->get('file');
        $carousel->need_show = $request->has('need_show') ? 1 : 0;
        $carousel->buttons = json_encode($buttons);

        $carousel->save();

        return redirect()->route('admin.carousel.get', ['item' => $carousel])->with('messages', ['Created successful']);
    }

    public function delete($id = null)
    {
        $slide = HeaderCarousel::find($id);

        if(!isset($slide)){
            return redirect(route('admin.carousel.list'))
                ->withErrors('Записи с таким ID не существует!');
        }

        \Storage::disk('uploads')->delete("carousel/$slide->background_file");

        $slide->delete();

        Session::flash('messages', ['Изменения успешно внесены!']);
        return back();
    }

    public function deleteImage($id = null)
    {
        $slide = HeaderCarousel::find($id);

        if(!isset($slide)){
            return redirect(route('admin.carousel.list'))
                ->withErrors('Записи с таким ID не существует!');
        }

        \Storage::disk('uploads')->delete("carousel/$slide->background_file");

        $slide->background_file = null;
        $slide->save();

        return redirect()->route('admin.carousel.get', ['item' => $slide]);
    }



}
