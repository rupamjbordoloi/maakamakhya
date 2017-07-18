@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
		<section class="content">
			<div class="col-md-10">
			  <div class="box">
			  	<div class="box-header">
              		<div class="col-md-offset-4"><h3 class="box-title">Available Products</h3></div><hr>
			  		<!--filter method-->
			  		{!!Form::open(['method'=>'GET', 'url'=>'allProducts/filter'])!!}
			  		  <div class="form-group col-md-4" id="filter" name="filter">
				  		  <div class="form-inline">
							  <span><em>Filter by Client:</em></span>
						      <select class="form-control myInput" id="filter" name="filter" onchange="this.form.submit()">
						      <option value=""> </option>
						      <option value="0">All</option>
						      @foreach($clients as $client)
						      <option value="{{$client->id}}">{{$client->name}}</option>
						      @endforeach
						      </select>
						   </div>
			    	   </div>
			    	{!!Form::close()!!}
			    	<!--filter close-->
			    	<!--search-->
			  		  {!!Form::open(['method'=>'GET', 'url'=>'allProducts', 'role'=>'search'])!!}
				        <div class="col-md-4">
				          <div class="input-group">
				              <input type="text" class="form-control myInput" name="search" placeholder="Search for...">
				              <span class="input-group-btn">
				                <button class="btn btn-default" type="submit">Go!</button>
				              </span>
				            </div>
				        </div>
				      {!!Form::close()!!}
				    <!--search close-->  
		              <div class="col-md-2 col-md-offset-2"><button class="btn btn-primary" aria-hidden="true" data-toggle="modal" data-target="#productAddModal">Add Product</button></div>
		        </div>

	            <div class="box-body">
			  	<table id="clientTable" class="table table-striped table-hover">
	                <thead>
	                <tr>
	                  <th>Name</th>
	                  <th>Client Name</th>
	                  <th>Rate per sq. feet</th>
	                 
	                </tr>
	                </thead>
	                @foreach($products as $product)
	                <tr>
	                	<td>{{$product->name}}</td>
	                	
	                	<td>{{$product->client['name']}}</td>
	                	<td>{{$product->sq_feet_rate}}</td>
	                </tr>
	                @endforeach
	            </table>
	            </div>
	             <div class="col-md-offset-4 col-md-4">
				    {{$products->links()}}
				 </div>

	            <!--modal for adding product-->


            <div id="productAddModal" class="modal fade" role="dialog">
			  <div class="modal-dialog">

			    <!-- Modal content-->
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
			        <h4 class="modal-title">Add Product</h4>
			      </div>
			      <div class="modal-body">
			      {!! Form::open(['method'=>'post','route'=>['addProduct.store']]) !!}
				        <div class="form-group">
					      <label for="productName">Product Name:</label>
					      <input type="text" class="form-control myInput" id="productName" placeholder="Enter product name" name="productName" required>
					    </div>

					    <div class="form-group">
					      <label class="switch">
							  <input type="checkbox" id="cb">
							  <div class="slider round"></div>
						  </label>
						  <span for="cb"><em>Click for client based product</em></span>
						</div>

						<div class="form-group" id="client" name="client">
						  <label>Select Client:</label>
					      <select class="form-control myInput">
					      @foreach($clients as $client)
					      <option value="{{$client->id}}">{{$client->name}}</option>
					      @endforeach
					      </select>
			    	    </div>

			    	    
					    <input type="hidden"  id="selected_client" name="selected_client">
			    	  

					    <div class="form-group">
					      <label for="sqFeetRate">Square Feet Rate(in Rupees):</label>
					      <input type="text" class="form-control myInput" id="sqFeetRate" placeholder="Enter square feet rate" name="sqFeetRate" required>
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
		</section><!--section close-->
    </div><!--row close-->
</div><!--container close-->
<script type="text/javascript">
$(document).ready(function(){
	$('#client').hide();
	$('#cb').prop('checked', false);
    
    $("#cb").change(function(){
      if(this.checked) 
      { 

        $('#client').show(); 
        var client= $('#client').find(":selected").val();
        document.getElementById("selected_client").value=client;
      }
      else
      { 
        $('#client').hide(); 
      }
      });
     $("#client").change(function(){
        var client= $('#client').find(":selected").val();
        document.getElementById("selected_client").value=client;
     
      });

     
    
});
</script>
<style type="text/css">
	.switch {
          position: relative;
          display: inline-block;
          width: 60px;
          height: 34px;
        }

        /* Hide default HTML checkbox */
        .switch input {display:none;}

        /* The slider */
        .slider {
          position: absolute;
          cursor: pointer;
          top: 0;
          left: 0;
          right: 0;
          bottom: 0;
          background-color: #ccc;
          -webkit-transition: .4s;
          transition: .4s;
        }

        .slider:before {
          position: absolute;
          content: "";
          height: 26px;
          width: 26px;
          left: 4px;
          bottom: 4px;
          background-color: white;
          -webkit-transition: .4s;
          transition: .4s;
        }

        input:checked + .slider {
          background-color: #2196F3;
        }

        input:focus + .slider {
          box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
          -webkit-transform: translateX(26px);
          -ms-transform: translateX(26px);
          transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
          border-radius: 34px;
        }

        .slider.round:before {
          border-radius: 50%;
        }
</style>
@endsection


