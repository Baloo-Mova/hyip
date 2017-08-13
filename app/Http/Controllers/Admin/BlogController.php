<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Article\CreateArticleRequest;
use App\Models\Article;
use Illuminate\Http\Request;

class BlogController extends BaseController
{
    private $_model;
    private $_view = 'blog';

    public function __construct(Article $model)
    {
        parent::__construct($model, $this->_view);
        $this->_model = $model;
    }

    public function postEdit(Request $request, $article_id = null )
    {
        $validator = \Validator::make($request->all(), with(new CreateArticleRequest())->rules());

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
        }

        if( empty($article_id) || !is_numeric($article_id) || !($article = $this->_model->find($article_id)) ) {
            $article = $this->_model;
        }

        if($image = $request->file('image')) {
            $origext  = $image->getClientOriginalExtension();
            $filename = generate_file_name(".{$origext}");

            \Storage::disk('blog')->put($filename, file_get_contents($image->getRealPath()));

            \Image::make($image->getRealPath())
                ->resize(300, 200)
                ->save(public_path('/media/uploads/blog') . '/prev-' . $filename, 60);

            $article->photo     = $filename;
            $article->preview   = 'prev-' . $filename;
        }

        $article->fill([
            'title'     => $request->get('title'),
            'uri'       => $request->get('uri'),
            'content'   => $request->get('content'),
            'published' => $request->get('published') ? $request->get('published') : 0,
        ]);

        $article->save();

        return redirect()->route('admin-get-single-article', ['id' => $article->id])->with('messages', ['Created successful']);
    }

    public function imageDelete( $article_id = null )
    {
        if( empty($article_id) || !is_numeric($article_id) || !($article = $this->_model->find($article_id)) ) {
            return response()->json([
                'success' => false,
                'message' => 'Incorrect identifier',
            ]);
        }

        if(!empty($article->photo) && \Storage::disk('blog')->exists($article->photo)) {
            \Storage::disk('blog')->delete($article->photo);
            \Storage::disk('blog')->delete('prev-' . $article->photo);

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

        if(!empty($article->photo) && \Storage::disk('blog')->exists($article->photo)) {
            \Storage::disk('blog')->delete($article->photo);
            \Storage::disk('blog')->delete('prev-' . $article->photo);
        }

        $article->delete();

        return redirect()->back();
    }
}