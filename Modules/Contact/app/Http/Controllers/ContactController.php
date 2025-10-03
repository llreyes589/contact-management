<?php

namespace Modules\Contact\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::all();
        return view('contact::index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contact::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $path = $request->file('image')->store('uploads');
        $contact->image = $path;
        $contact->save();
        return response()->json(['statusCode' => 200, 'message' => 'Contact successfully saved.', 'data' => $contact]);
    }
    
    /**
     * Show the specified resource.
    */
    public function show($id)
    {
        return view('contact::show');
    }
    
    /**
     * Show the form for editing the specified resource.
    */
    public function edit($id)
    {
        return view('contact::edit');
    }
    
    /**
     * Update the specified resource in storage.
    */
    public function update(Request $request, Contact $contact) {

        $contact->name = $request->name;
        $contact->email = $request->email;
        $path = $contact->image;
        if($request->hasFile('image')){

            $path = $request->file('image')->store('uploads');
        }
        $contact->image = $path;
        $contact->save();
        return response()->json(['statusCode' => 200, 'message' => 'Contact successfully updated.', 'data' => $contact]);
    }
    
    /**
     * Remove the specified resource from storage.
    */
    public function destroy($id) {
        Contact::destroy($id);
        return response()->json(['statusCode' => 200, 'message' => 'Contact successfully deleted.']);
    }
}
