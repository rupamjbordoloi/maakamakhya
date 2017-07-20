@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
		<section class="content">
		 <div class="col-md-10">
		  <div class="box">
		 	<div class="box-header">
              	  <div class="col-md-offset-4"><h3 class="box-title">Client Details</h3></div><hr>
	              <div class="col-md-2 pull-right"><button class="btn btn-primary" aria-hidden="true" data-toggle="modal" data-target="#taxAddModal">Add Tax</button></div>
	        </div>
	        <div class="box-body">
			  	<table id="taxTable" class="table table-striped table-hover">
	                <thead>
	                <tr>
	                  <th>Name</th>
	                  <th>Percent</th>
	                  <th></th>
	                </tr>
	                </thead>
	                <tbody>
	                @foreach($taxes as $tax)
	                	<tr>
	                		<td>{{$tax->name}}</td>
	                		<td>{{$tax->percent}}</td>
	                	</tr>
	                @endforeach
	                </tbody>
	               
	            </table>
	        </div>

	        <div id="taxAddModal" class="modal fade" role="dialog">
			  <div class="modal-dialog">

			    <!-- Modal content-->
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title">Add Tax</h4>
			      </div>
			      <div class="modal-body">
			      {!! Form::open(['method'=>'post','route'=>['allTaxes.store']]) !!}
				        <div class="form-group">
					      <label for="taxName">Tax Name:</label>
					      <input type="text" class="form-control myInput" id="taxName" placeholder="Enter Tax name" name="taxName" required>
					    </div>
					    <div class="form-group">
					      <label for="percent">Percent:</label>
					      <input type="number" class="form-control myInput" id="percent" placeholder="Enter percent" name="percent" required>
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

		  </div><!--box close-->
		  </div>
		</section><!--section close-->
    </div><!--row close-->
</div><!--container close-->
@endsection
