<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Admin\BaseController;
use App\Http\Requests\Contact\CreateContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends BaseController
{
    private $_model;
    private $_view = 'contacts';

    public function __construct(Contact $model)
    {
        parent::__construct($model, $this->_view);
        $this->_model = $model;
    }

    public function index()
    {
        $contacts = Contact::paginate(10);
        return view('Admin::content.contacts.list', ['items' => $contacts]);
    }

    public function getAdd()
    {
        return view('Admin::content.contacts.edit');
    }

    public function getEdit($item_id = null)
    {
        $item = Contact::whereId($item_id)->first();
        return view('Admin::content.contacts.edit', ['item' => $item]);
    }

    public function postEdit(Request $request, $contact_id = null )
    {
        $validator = \Validator::make($request->all(), with(new CreateContactRequest())->rules());

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
        }

        if( empty($contact_id) || !is_numeric($contact_id) || !($contact = $this->_model->find($contact_id)) ) {
            $contact = $this->_model;
        } else {
            $contact->published = $request->get('published') ? $request->get('published') : 0;
        }

        $contact->fill([
            'type_id'  => $request->get('type_id'),
            'value' => $request->get('value'),
        ]);

        $contact->save();

        return redirect()->route('admin.contact.get', ['id' => $contact->id])->with('messages', ['Created successful']);
    }
}