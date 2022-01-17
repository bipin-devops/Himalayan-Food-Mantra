<?php

namespace App\Http\Controllers\Frontend;

use App\Contact;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('Frontend.contact');
    }

    public function postContact(Request $request)
    {

        try {
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['phone_number'] = $request->phone_number;
            $data['address'] = $request->address;
            $data['message'] = $request->message;
            Contact::create($data);
            return redirect('/contact-us')->withErrors(['alert-success' => 'Successfully Sent Message']);
        } catch (\Exception $exception) {

            return redirect()->back()->withErrors(['alert-danger' => 'Something went wrong']);
        }
    }
}
