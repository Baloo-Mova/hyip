<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Article\CreateArticleRequest;
use App\Http\Requests\Contact\CreateContactRequest;
use App\Models\Article;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('Admin::contacts.list', [
            'items' => Contact::paginate(15),
        ]);
    }

    public function getAdd()
    {
        return $this->getEdit();
    }


    public function getEdit($contact_id = null)
    {
        if( empty($contact_id) || !is_numeric($contact_id) || !($contact = Contact::find($contact_id)) ) {
            $contact = new Contact();
        }

        return view('Admin::contacts.edit', [
            'contact' => $contact
        ]);
    }

    public function postAdd(Request $request)
    {
        return $this->postEdit($request);
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

    public function delete( $contact_id = null )
    {
        if( empty($contact_id) || !is_numeric($contact_id) || !($contact = Contact::find($contact_id)) ) {
            return response()->json([
                'success' => false,
                'message' => 'Incorrect identifier',
            ]);
        }

        $contact->delete();

        return redirect()->back();
    }
}