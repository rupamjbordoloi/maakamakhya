<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Industry;
use App\User;
use App\Client;

class ClientController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function newClient()
    {
        $industries=Industry::all();
        $users=User::all();
        return view('client.newClient',array('user' => Auth::user(),'industries' => $industries, 'users' => $users));
    }

     public function allClients()
    {
        $client=Client::paginate(2);
        return view('client.allClients',array('user' => Auth::user(), 'clients' => $client));
    }

    public function index()
    {
        //
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
       
        $industries=Industry::all();
        $users=User::all();

        $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'vat' => 'required|integer',
                'companyName' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:clients',
                'address' => 'required|string|max:255',
                'zipCode' => 'required|integer',
                'city' => 'required|string|max:255',
                'saddress' => 'required|string|max:255',
                'szipCode' => 'required|integer',
                'scity' => 'required|string|max:255',
                'primaryNo' => 'required|integer',
                'secondaryNo' => 'required|integer',
                'companyType' => 'required|string|max:255',
                'industry' => 'required|integer',
                'assignUser' => 'required|integer', 
                ]);

        if ($validator->fails()) {
            
            return redirect()->to($this->getRedirectUrl())
                    ->withInput()
                    ->withErrors($validator, $this->errorBag())
                    ->with('failedMessage', 'Fill the form correctly!');
            } 


        else{
                $newClient=new Client;
                $newClient->name=$request->name;
                $newClient->vat=$request->vat;
                $newClient->company_name=$request->companyName;
                $newClient->email=$request->email;
                $newClient->address=$request->address;
                $newClient->zipcode=$request->zipCode;
                $newClient->city=$request->city;
                $newClient->saddress=$request->saddress;
                $newClient->szipcode=$request->szipCode;
                $newClient->scity=$request->scity;
                $newClient->primary_number=$request->primaryNo;
                $newClient->secondary_number=$request->secondaryNo;
                $newClient->company_type=$request->companyType;
                $newClient->industry_id=$request->industry;
                $newClient->fk_user_id=$request->assignUser;
                $newClient->save();
                return view('client.newClient',array('user' => Auth::user(),'industries' => $industries, 'users' => $users))
                    ->with('successMessage', 'Client added successfully!');

            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $client=Client::find($id);
        $client->name=$request->name;
        $client->company_name=$request->companyName;
        $client->email=$request->email;
        $client->primary_number=$request->primaryNo;
        $client->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Client::destroy($id);
        $client=Client::all();
        return view('client.allClients',array('user' => Auth::user(), 'clients' => $client));
    }
}
