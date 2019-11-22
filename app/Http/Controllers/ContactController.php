<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Http\Resources\Contact as ContactResource;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index()
    {
        $contacts = request()->user()->contacts;
        return  ContactResource::collection($contacts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $contact = $request->user()->contacts()->create($request->all());
       return new ContactResource($contact);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        return new ContactResource($contact);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
  

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        if(request()->user()->id !==$contact->user_id){
            return response()->json(['error'=>'Unathorized action', 401]);
        }
        $contact->update($request->all());
        return new ContactResource($contact);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        if(request()->user()->id !==$contact->user_id){
            return response()->json(['error'=>'Unathorized action', 401]);
        }
        $contact = $contact->delete();
        return response()->json(null,200);
    }
}
