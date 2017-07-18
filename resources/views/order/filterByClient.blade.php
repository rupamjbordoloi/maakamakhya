@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
		<section class="content">
		 <div class="col-md-10">
		  <div class="box">
		 	<div class="box-header">
              	  <div class="col-md-offset-4"><h3 class="box-title">Order Details</h3></div><hr>
	              <a href="/newOrder" class="btn btn-primary pull-right">Place an Order</a>
	               <a href="/allOrders" class="btn btn-primary pull-lest">View all Orders</a>
	        </div>
		  	<div class="box-body">
		          @foreach($orders as $order)
		          	<div>Client Name:<strong>{{$order->client['name']}}</strong></div>
		          	<div>Product Name:<strong>{{$order->product['name']}}</strong></div>
		          	<div>Square Feet:<strong>{{$order->sq_feets}}</strong></div>
		          	<div>Total Price<strong>{{$order->estimated_rate}}</strong></div><hr>
		          @endforeach
		          
	        </div>
		  </div><!--box close-->
		  </div>
		</section><!--section close-->
    </div><!--row close-->
</div><!--container close-->
@endsection
