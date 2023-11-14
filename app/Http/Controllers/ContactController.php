<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use Mail;
use App\Mail\TechnicalSupport;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $contacts = Contact::orderBy('id', 'DESC')->paginate(12);
        return view('dashboard.contacts', ['title_page' => 'contacts_us', 'contacts' => $contacts]);
    }

    public function details($id)
    {
        $contact = Contact::whereId($id)->first();
        if (!$contact) {
            return redirect()->back();
        }
        return view('dashboard.contact_details', ['title_page' => 'message_details', 'contact' => $contact]);
    }

    public function send(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'id' => ['required', 'exists:contacts,id'],
            'response' => ['required', 'string'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withInput($data)->withErrors($validator->errors());
        }
        $contact = Contact::whereId($data['id'])->first();
        if (!$contact) {
            return redirect()->back();
        }

        $data_message = array('id' => $contact->id, 'name' => $contact->name, 'response' => $data['response']);
        try {
            Mail::to($contact->email, $contact->name)
                ->cc(env('MAIL_USERNAME'), env('APP_NAME'))
                ->send(new TechnicalSupport($data_message));
            $contact->update(['response' => $data['response'], 'status' => 2]);
            return back()->with('message', 'Successfully');
        } catch (Exception $e) {
            return back()->with('message', 'Fail');
        }
    }
}
//Developed Saed Z. Sinwar
