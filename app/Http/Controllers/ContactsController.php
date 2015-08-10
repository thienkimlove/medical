<?php namespace App\Http\Controllers;

use App\Contact;
use App\Http\Requests;


class ContactsController extends Controller {

    public function __construct()
    {
        $this->middleware('admin');
	}

    public function index()
    {
       $contacts =  Contact::latest('updated_at')->paginate(10);
       return view('admin.contact.index', compact('contacts'));
    }

    public function show($id)
    {
       $contact = Contact::findOrFail($id);
       return view('admin.contact.show', compact('contact'));
    }


}
