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

	        </div>
		  	<div class="box-body">
			  	<table id="clientTable" class="table table-striped table-hover">
	                <thead>
	                <tr>
	                  <th>Order No.</th>
	                  <th>Name</th>
	                  <th>Client Name</th>
	                  <th>Sq. feet</th>
	                  <th>Total Price</th>
	                  <th>Created At</th>
	                  <th>Approval</th>
	                  <th></th>
	                </tr>
	                </thead>
	                <tbody>
	                @foreach($orders as $order)
	                <tr>
	                	<td><a href="/orderDetail/{{$order->id}}">{{$order->order_id}}</a></td>
	                	<td><a href="/filterByClient/{{$order->fk_client_id}}">{{$order->client['name']}}</a></td>
	                	<td>{{$order->product['name']}}</td>
	                	<td>{{$order->sq_feets}}</td>
	                	<td>{{$order->estimated_rate}}</td>
	                	<td>{{$order->created_at}}</td>
	                	<td>
	                	@role('admin')
	                	@if($order->approval==1) 
	                			Approved
	                	@elseif($order->approval==2)<a href="/approve/{{$order->id}}" class="btn btn-primary">Approve</a>		
	                	@endif	
	                	@endrole
	                	@role('manager')
	                		@if($order->approval==1) 
	                			Approved	
	                		@elseif($order->approval==2)<a href="/getApproved/{{$order->id}}" class="btn btn-primary">Send for approval</a>
	                		@else <a href="/getApproved/{{$order->id}}" class="btn btn-primary">Not yet send for approval</a>
	                		@endif
	                	@endrole

	                	</td>
	                	
	                	<td class="col-md-2">
	                    <button class="btn btn-default glyphicon glyphicon-pencil" aria-hidden="true" data-toggle="modal" data-target="#myModal{{$order->id}}"></button>

	                    <div id="myModal{{$order->id}}" class="modal fade" role="dialog">
						  <div class="modal-dialog">

						    <!-- Modal content-->
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal">&times;</button>
						        <h4 class="modal-title">Edit order details</h4>
						      </div>
						      <div class="modal-body">
						      {!! Form::open(['method'=>'patch','route'=>['updateOrder.update',$order->id]]) !!}
							        <div class="form-group">
								      <label for="name">Order Id:</label>
								      <input type="text" class="form-control myInput" id="name" placeholder="Change Order Id" name="name" value="{{$order->order_id}}">
								    </div>
								  
								   {!!Form::submit('Submit',['class' => 'btn btn-default'])!!}
							   {!! Form::close() !!}
						      </div>
						      <div class="modal-footer">
						        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						      </div>
						    </div>

						  </div>
						</div>

	                    {!! Form::open(['class'=>'form-inline pull-right','method'=>'delete','route'=>['removeOrder.destroy',$order->id]]) !!}
	                    <button type="submit" class="btn btn-default glyphicon glyphicon-remove" aria-hidden="true"></button>
	                    {!!Form::close()!!}
	                  
	                	</td>
	                </tr>
	                @endforeach
	                </tbody>
	            </table>
	            </div>
	             <div class="col-md-offset-4 col-md-4">
				   {{$orders->links()}}
				 </div>





		  </div><!--box close-->
		  </div>
		</section><!--section close-->
    </div><!--row close-->
</div><!--container close-->
@endsection
