<?php

namespace App\Http\Controllers\Admin;

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

    public function postEdit(Request $request, $contact_id = null )
    {
        $validator = \Validator::make($request->all(), with(new CreateContactRequest())->rules());

        if ($validator->fails()) {
            return redirect()->back()->withInput($request->all())->withErrors($validator->errors());
        }

        if( empty($contact_id) || !is_numeric($contact_id) || !($contact = Contact::find($contact_id)) ) {
            $contact = new Contact();
        }

        $contact->fill([
            'name'  => $request->get('name'),
            'value' => $request->get('value'),
        ]);

        $contact->save();

        return redirect()->route('admin-get-contact', ['id' => $contact->id])->with('messages', ['Created successful']);
    }
}