<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Auth;
use App\Register;
use App\RoleUser;
use App\Role;
use App\User;
use Entrust;


class RegisterController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $roles=Role::all();
        return view('register.register',array('user' => Auth::user(),'roles' => $roles));
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
        
          $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
                'password_confirmation' => 'required|string|min:6',
                'phone_no' => 'required|integer',
                ]);

         if ($validator->fails()) {
            return redirect('/Register')
                        ->withErrors($validator)
                        ->withInput()
                        ->with('failedMessage', 'Fill the form correctly!');
            }

        else{

                
                $newUser=new Register;
                $newUser->name=$request->name;
                $newUser->email=$request->email;
                $newUser->password=bcrypt($request->password);
                $newUser->phone_no=$request->phone_no;
                $newUser->address=$request->address;
                $newUser->save();
                
                $newRoleUser= new RoleUser;
                $newRoleUser->user_id= $newUser->id;
                $newRoleUser->role_id=$request->selected_user_type;
                $newRoleUser->save();
                return back()->with('successMessage', 'User added successfully');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
