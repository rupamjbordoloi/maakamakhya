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
		  			<div class="">@foreach($orders->slice(0,1) as $order)
					  					<center><strong>{{$order->client['name']}}</strong></center>
					  				  @endforeach
					  	</div>
		         

		          <table class="table table-striped table-bordered table-hover">
 				  		<tr>
 				  			<th class="info">Product</th>
 				  			<th class="info">Square Feet</th>
 				  			<th class="info">Rate</th>
 				  			<th class="info">Tax</th>
 				  			<th class="info">Balance Estimated</th>
 				  			<th class="info">Balance Square Feet</th>
 				  			<th class="info">Amount</th>
 				  		</tr>
				          @foreach($orders as $order)
				          	<tr>
				          	<td>{{$order->product['name']}}</td>
				          	<td>{{$order->sq_feets}}</td>
				          	<td>{{$order->product['sq_feet_rate']}}</td>
				          	<td>{{$order->tax['name']}} {{$order->tax['percent']}}%</td>
				          	<td>{{$order->balance_estimate}}</td>
				          	<td>{{$order->balance_sq_feets}}</td>
				          	<td>{{$order->estimated_rate}}</td>
				          	</tr>
				          @endforeach
				            <tr>
				            <?php  $i=0;?>
							    <td  colspan="6" align="right">Total</td>
							    @foreach($orders as $order)
							    <?php $i=$i+$order['estimated_rate']; ?>
							    @endforeach
							    <td>{{$i}}</td>
							 </tr>
			         </table>
		          
	        </div>
		  </div><!--box close-->
		  </div>
		</section><!--section close-->
    </div><!--row close-->
</div><!--container close-->
@endsection
