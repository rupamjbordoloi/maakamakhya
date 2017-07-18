@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
		<section class="content">
		  <div class="col-md-10">
		  	<div class="box">
		  		<div class="box-header">
              	  <div class="col-md-offset-4"><h3 class="box-title">Client Details</h3></div><hr>
	              <a href="/newClient" class="btn btn-primary pull-right">Add Client</a>

	            </div>
	            <div class="box-body">
			  	<table id="clientTable" class="table table-striped table-hover">
	                <thead>
	                <tr>
	                  <th>Name</th>
	                  <th>Company Name</th>
	                  <th>Email</th>
	                  <th>Phone No</th>
	                  <th> </th>
	                </tr>
	                </thead>
	                @foreach($clients as $client)
	                <tbody>
	                <tr>
	                  <td>{{$client->name}}</td>
	                  <td>{{$client->company_name}}</td>   
	                  <td>{{$client->email}}</td>
	                  <td>{{$client->primary_number}}</td>    
	                  <td class="col-md-2">
	                    <button class="btn btn-default glyphicon glyphicon-pencil" aria-hidden="true" data-toggle="modal" data-target="#myModal{{$client->id}}"></button>

	                    <div id="myModal{{$client->id}}" class="modal fade" role="dialog">
						  <div class="modal-dialog">

						    <!-- Modal content-->
						    <div class="modal-content">
						      <div class="modal-header">
						        <button type="button" class="close" data-dismiss="modal">&times;</button>
						        <h4 class="modal-title">Edit clients details</h4>
						      </div>
						      <div class="modal-body">
						      {!! Form::open(['method'=>'patch','route'=>['updateClient.update',$client->id]]) !!}
							        <div class="form-group">
								      <label for="name">Name:</label>
								      <input type="text" class="form-control myInput" id="name" placeholder="Enter name" name="name" value="{{$client->name}}">
								    </div>
								  <div class="form-group">
								      <label for="companyName">Company Name:</label>
								      <input type="text" class="form-control myInput" id="companyName" placeholder="Enter company name" name="companyName" value="{{$client->company_name}}">
						    	  </div>
								  <div class="form-group">
								      <label for="email">Email:</label>
								      <input type="email" class="form-control myInput" id="email" placeholder="Enter email" name="email" value="{{$client->email}}">
							      </div>
							      <div class="form-group">
								      <label for="primaryNo">Primary No:</label>
								      <input type="number" class="form-control myInput" id="primaryNo" placeholder="Enter primary no" name="primaryNo" value="{{$client->primary_number}}">
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

	                    {!! Form::open(['class'=>'form-inline pull-right','method'=>'delete','route'=>['removeClient.destroy',$client->id]]) !!}
	                    <button type="submit" class="btn btn-default glyphicon glyphicon-remove" aria-hidden="true"></button>
	                    {!!Form::close()!!}
	                  </td>
	                </tr>
	                </tbody>
	                @endforeach
	            </table>
	           </div>
	           <div class="col-md-offset-4 col-md-4">
				    {{$clients->links()}}
			   </div>
	        </div>
		  </div><!--box close-->
		</section><!--section close-->
    </div><!--row close-->
</div><!--container close-->
@endsection
