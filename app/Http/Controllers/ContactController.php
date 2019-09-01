<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use Yajra\DataTables\DataTables;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('allContact');
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
        $data = [
            'name' => $request['name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'religion' => $request['religion']
        ];
        return Contact::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        return $contact;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        return $contact;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $contact=Contact::find($id);
        $contact->name=$request['name'];
        $contact->phone=$request['phone'];
        $contact->email=$request['email'];
        $contact->religion=$request['religion'];
        $contact->update();
        return $contact;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Contact::destroy($id);
    }

    public function allContact()
    {
        $contact=Contact::all();
        return Datatables::of($contact)
          ->addColumn('action', function($contact){
             return '<a onclick="showData('.$contact->id.')" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>'.' '. 
                    '<a onclick="editForm('.$contact->id.')" class="btn btn-sm btn-info"><i class="fa fa-pencil-square-o"></i></a>'.' '. 
                    '<a onclick="deleteData('.$contact->id.')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>';

          })->make(true);
    }
}
