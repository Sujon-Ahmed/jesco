<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $phone = User::where('role_as', 1)->first()->phone;
        $email = User::where('role_as', 1)->first()->email;
        $address = User::where('role_as', 1)->first()->address;
        return view('frontend.contact', compact('phone', 'email', 'address'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required',
            'email'   => 'required | email:rfc,dns',
            'message' => 'required'
        ]);

        $contact = new Contact();
        $contact->name      = $request->name;
        $contact->email     = $request->email;
        $contact->message   = $request->message;
        $contact->save();
        return back()->with('status', 'Your Message Submit Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function visitorQuoteDelete(Contact $contact, $id)
    {
        Contact::find(decrypt($id))->delete();
        return back()->with('status', 'Visitor Quote Delete Successfully!');
    }
    // visitor quotes
    public function visitorQuotes()
    {
        $visitors = Contact::orderBy('id', 'DESC')->get();
        return view('backend.Visitor_Quote.index', compact('visitors'));
    }
}
