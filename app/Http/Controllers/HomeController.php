<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Entrust;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Entrust::hasRole('admin')){
            return view('home',array('user' => Auth::user()));
        }
        if(Entrust::hasRole('manager')){
            return view('home',array('user' => Auth::user()));
        }
        else{
            return view('home',array('user' => Auth::user()));
        }
        
    }

    public function profile()
    {
        return "profile page";
    }
}
