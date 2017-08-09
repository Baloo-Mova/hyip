<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    private $_model;
    private $_view;

    public function __construct($model, $view)
    {
        $this->_model = $model;
        $this->_view  = $view;
    }

    protected function index()
    {
        return view('Admin::' . $this->_view . '.list', [
            'items' => $this->_model->paginate(15),
        ]);
    }

    public function getAdd()
    {
        return $this->getEdit();
    }


    public function getEdit($item_id = null)
    {
        if( empty($item_id) || !is_numeric($item_id) || !($item = $this->_model->find($item_id)) ) {
            $item = $this->_model;
        }

        return view('Admin::' . $this->_view . '.edit', [
            'item' => $item
        ]);
    }

    public function postAdd(Request $request)
    {
        return $this->postEdit($request);
    }

    public function delete($item_id = null)
    {
        if( empty($item_id) || !is_numeric($item_id) || !($item = $this->_model->find($item_id)) ) {
            return response()->json([
                'success' => false,
                'message' => 'Incorrect identifier',
            ]);
        }

        $item->delete();

        return redirect()->back()->with('messages', ['Delete successful']);
    }
}