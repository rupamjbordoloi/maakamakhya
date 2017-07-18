<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Client;
use App\Product;
use App\User;
use App\Industry;

class ProductController extends Controller
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
    public function index()
    {
        
    }

    public function allProducts()
    {
         

        $search=\Request::get('search');
        $clients=Client::all();
        $products=Product::where('name','like','%'.$search.'%')->orderBy('id')
                        ->orWhere('sq_feet_rate','like','%'.$search.'%')->orderBy('id')
                        ->paginate(5);
        return view('product.allProducts',array('user' => Auth::user(), 'clients' => $clients, 'products' => $products));
    }

    public function filter()
    {
        $filter=\Request::get('filter');
        $clients=Client::all();
        $search="";
        if($filter==0){
            $products=Product::where('name','like','%'.$search.'%')->orderBy('id')
                        ->orWhere('sq_feet_rate','like','%'.$search.'%')->orderBy('id')
                        ->paginate(5);

        }
        else{

        $products=Product::where('fk_client_id','like','%'.$filter.'%')->orderBy('id')
                        ->paginate(5);
            }
        return view('product.allProducts',array('user' => Auth::user(), 'clients' => $clients, 'products' => $products));
        
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
        
        $newProduct=new Product;
        $newProduct->name=$request->productName;
        $newProduct->fk_client_id=$request->selected_client;
        $newProduct->sq_feet_rate=$request->sqFeetRate;
        $newProduct->save();
        return back();
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
