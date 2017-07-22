<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Order;
use App\Industry;
use App\Client;
use App\Product;
use App\User;
use Entrust;
use DB;
use App\Tax;
use Illuminate\Support\Facades\Input;

class OrderController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function newOrder()
    {
        
        $clients=Client::all();
        $products=Product::all();
        $taxes=Tax::all();
        $industries=Industry::all();
        $users=User::all();
        return view('order.newOrder',array('user' => Auth::user(), 'clients' => $clients, 'products' => $products, 'taxes'=> $taxes,'industries'=>$industries,'users'=>$users));
    }

     public function allOrders()
    {
        $orders=Order::select('id','order_id','fk_product_id','order_date','fk_client_id','fk_product_id', 'sq_feets','fk_tax_id','estimated_rate','approval')
                        ->groupBy('order_id')->orderBy('id')->paginate(5);
        $clients=Client::all();
        return view('order.allOrders',array('user' => Auth::user(), 'orders' => $orders, 'clients' => $clients));
    }

    public function getAllProduct(){

       
       $productList=Product::all();
       return \Response::json($productList);

    }

    public function getProduct(){

       $client_id=Input::get("client_id");
       if($client_id==0){
            $productList=Product::all();
            return \Response::json($productList);
       }
       else{
            $productList=Product::where('fk_client_id','=',$client_id)->get();
            return \Response::json($productList);
       }
       

    }

    public function getTax(){

       $tax_id=Input::get("tax_id");
       
            $percent=Tax::where('id','=',$tax_id)->get(['percent']);
            return \Response::json($percent);
       
       

    }

    public function getSqFeetRate(){

       $client_id=Input::get("client_id");
       $product_id=Input::get("product_id");
       if($client_id==0){
           $sqFeetRate=Product::where('id','=',$product_id)
                                ->get();
           return \Response::json($sqFeetRate);
        }
        else{
            
           $sqFeetRate=Product::where('fk_client_id','=',$client_id)
                                ->where('id','=',$product_id)
                                ->get();
           return \Response::json($sqFeetRate);
        }

    }

    public function orderBill($orderNo){

        $orders=Order::where('order_id','=',$orderNo)->get();
        $clientName=Order::where('order_id','=',$orderNo) ->select('fk_client_id') ->get()->first();
           
        $clients=Client::all();
        return view('order.orderBill',array('user' => Auth::user(), 'orders' => $orders, 'clientName' => $clientName));

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

    public function getApproved($order_id){
        if(Entrust::hasRole('manager')){
            $orders=Order::where('order_id','=',$order_id)->get();
        
            foreach($orders as $order){
                $order->approval=2;
                $order->save();
                
            }
            return back();
            
        }
        else{
            return back();
        }
        
       

    }

    public function approve($order_id){
        if(Entrust::hasRole('admin')){
            $orders=Order::where('order_id','=',$order_id)->get();
            foreach($orders as $order){
                $order->approval=1;
                $order->save();
                return back();
            }
        }

        else{
            return back();
        }
        

    }

    public function orderDetail($id){
        $order=Order::find($id);
        $clients=Client::all();
        return view('order.orderDetail',array('user' => Auth::user(), 'order' => $order, 'clients' => $clients));
    }

    public function filterByClient($id){
        $client=Client::find($id);
        $orders=Order::where('fk_client_id','=',$id)->get();
        return view('order.filterByClient',array('user' => Auth::user(), 'orders' => $orders, 'client' => $client));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            
                $orders=$request['order'];

                $lastId=Order::all();
                if($lastId->isEmpty()){

                    $orderNo=1;
                }
                else{
                    $orderNo=$lastId->last()->id;
                    $orderNo=$orderNo+1;
                    
                }
                              
                           
                foreach($orders as $order){
                    try{$newOrder=new Order;  
                            $newOrder->order_id="MK-00".$orderNo;
                            $newOrder->fk_client_id=$order['0'];
                            $newOrder->fk_product_id=$order['1'];
                            $newOrder->sq_feets=$order['2'];
                            $newOrder->fk_tax_id=$order['3'];
                            $newOrder->order_date=$order['4'];
        
                            $newOrder->estimated_rate=$order['5'];
                            if(Auth::user()->hasRole('admin')){
                                $newOrder->approval=1;
                            }
                            else{
                                $newOrder->approval=0;
                            }
                            $newOrder->fk_user_created_id=Auth::user()->id;
                            $newOrder->save();  
                        }
                        catch(\Exception $e){
                            
                        }
                        
                }
                $orderDetail="MK-00".$orderNo;
                return \Response::json($orderDetail); 

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
        Order::destroy($id);
        return back();
    }
}
