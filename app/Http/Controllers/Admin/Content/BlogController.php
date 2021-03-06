<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\Article\CreateArticleRequest;
use App\Models\Article;
use Illuminate\Http\Request;

class BlogController extends BaseController
{
    private $_model;
    private $_view = 'content.blog';

    public function __construct(Article $model)
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
            $list = Article::paginate(15);
        }else{
            $list = Article::where(['lang' => $lang])->paginate(15);
        }
        return view('Admin::content.blog.list', ['items' => $list,'lang' => $lang]);
    }

    public function postEdit(Request $request, $article_id = null )
    {
        $validator = \Validator::make($request->all(), with(new CreateArticleRequest())->rules());

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
        }

        if( empty($article_id) || !is_numeric($article_id) || !($article = $this->_model->find($article_id)) ) {
            $article = $this->_model;
        } else {
            $article->published = $request->get('published') ? $request->get('published') : 0;
        }

        if($image = $request->file('image')) {
            $origext  = $image->getClientOriginalExtension();
            $filename = generate_file_name(".{$origext}");

            \Storage::disk('uploads')->put("blog/$filename", file_get_contents($image->getRealPath()));

            \Image::make($image->getRealPath())
                ->resize(300, 200)
                ->save(storage_path('/media/uploads/blog') . '/prev-' . $filename, 60);

            $article->photo     = $filename;
            $article->preview   = 'prev-' . $filename;
        }

        $article->type_id = $request->has('is_stock') ? 2 : 1;

        $article->fill([
            'title'     => $request->get('title'),
            'uri'       => $request->get('uri'),
            'content'   => $request->get('content'),
            'lang'      => $request->get('lang'),
        ]);

        $article->save();

        return redirect()->route('admin.articles.get', ['id' => $article->id])->with('messages', ['Created successful']);
    }

    public function imageDelete( $article_id = null )
    {
        if( empty($article_id) || !is_numeric($article_id) || !($article = $this->_model->find($article_id)) ) {
            return response()->json([
                'success' => false,
                'message' => 'Incorrect identifier',
            ]);
        }

        if(!empty($article->photo) && \Storage::disk('uploads')->exists("blog/$article->photo")) {
            \Storage::disk('uploads')->delete("blog/$article->photo");
            \Storage::disk('uploads')->delete("blog/prev-$article->photo");

            $article->photo = '';
            $article->preview = '';
            $article->save();

            return response()->json([
                'success' => true,
            ]);
        }

        return response()->json([
            'success' => false,
        ]);
    }

    public function delete( $article_id = null )
    {
        if( empty($article_id) || !is_numeric($article_id) || !($article = $this->_model->find($article_id)) ) {
            return response()->json([
                'success' => false,
                'message' => 'Incorrect identifier',
            ]);
        }

        if(!empty($article->photo) && \Storage::disk('uploads')->exists("blog/$article->photo")) {
            \Storage::disk('uploads')->delete("blog/$article->photo");
            \Storage::disk('uploads')->delete("blog/prev-$article->photo");
        }

        $article->delete();

        return redirect()->back();
    }
}