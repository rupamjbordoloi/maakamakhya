@extends('layouts.app')

@section('content')
<div class="container">    
	<section class="content">		
		<div class="row">
		  	<div class="col-md-12">		  
		  		<!--container for added product-->		  
			  	<div class="col-md-8">
				    <div class="box">
					  <div class="box-body">
					  	<form id="tableForm" method="post" action="{{ route('newOrder.store') }}">
						  	<meta name="csrf-token" content="{{ Session::token() }}"> 
						  	<table class="table table-striped table-hover" id="myTable" name="myTable[]">
						  		<thead>
					                <tr>
					                  <th>Client</th>
					                  <th>Product</th>
					                  <th>Square Feet</th>
					                  <th>Price</th> 
					                  <th> </th> 
					                </tr>
					            </thead>
					            <tbody></tbody>
						  	</table>
						  	<hr>
						  	<div class="form-group">
						  		<table class="table table-striped table-hover">
						  			<tbody>
						  				<tr>
						  					<th class="pull-right col-md-4 " id="total">Total: 00.00</th>
						  				</tr>
						  			</tbody>
						  		</table>
						  	</div>
					  		<div class="form-group">
								<input type="button" class="btn btn-primary" id="submit" value="submit">
							</div>
						</form>
					   </div>
					</div>		  	
			  	</div>
		  		             	
            	<div class="col-md-4">            		
            		<div class="box">	  	
	            		<div class="box-body">            					            	
						    <div class="form-group">
							  <label>Select Client:</label>
						      <select class="form-control myInput" id="client" name="client">
						      <option value="0">--select client--</option>
						      @foreach($clients as $client)
						      <option value="{{$client->id}}">{{$client->name}}</option>
						      @endforeach
						      </select>
				    	    </div>

				    	    <div class="form-group">
							  <label>Select Product:</label>
						      <select class="form-control myInput" id="product" name="product">
						      </select>
				    	    </div>

				    	    <div class="form-group">
							  <label>Square feet:</label>
						      <input type="number" class="form-control myInput" id="sq_feet" name="sq_feet" required>
				    	    </div>

				    	    <div class="form-group">
							  <label>Square feet rate:</label>
						      <input type="number" class="form-control myInput" id="sq_feet_rate" name="sq_feet_rate" required>
				    	    </div>
				    	    
						    <div class="form-group">
						    <input type="button" class="btn btn-primary" id="addOrder" value="Add Order"> 
						    </div>				    
						</div>
			    	</div>			            
            	</div>
		  	</div>		  
		</div><!--row close-->
	</section><!--section close-->   
</div><!--container close-->

<script>



	$("#client").on('change',function(e){
		var client_id=e.target.value;
		$.get('/getProduct?client_id='+client_id,function(data){
			$('#product').empty();
			$('#sq_feet').val("");
			$('#sq_feet_rate').val("");
			$('#product').append('<option value="0">--select product--</option');
			$.each(data,function(index,productList){

				$('#product').append('<option value="'+productList.id+'">'+productList.name+'</option');

				
			});
		});

	});

	

	$("#product").on('change',function(e){
		var product_id=e.target.value;
		$('#sq_feet').val("");
		$('#sq_feet_rate').val("");
		var client_id=$("#client").find( "option:selected" ).prop("value");
		$.get('/getSqFeetRate?client_id='+client_id+'&product_id='+product_id,function(data){
			$.each(data,function(index,sqFeetRate){

				$('#sq_feet_rate').val(sqFeetRate.sq_feet_rate);
				rate=$('#sq_feet_rate').val();
				$('#sq_feet').val('1');
				
			});

			
		});

	});


	$('#sq_feet').on("input", function() {
    	var dInput = this.value;	
   		$('#sq_feet_rate').val(dInput*rate);
	});


var orders = Array();	

	$(document).ready(function(){

		$.get('/getAllProduct',function(data){
			$('#product').empty();
			$('#sq_feet').val("");
			$('#sq_feet_rate').val("");
			$('#product').append('<option value="0">--select product--</option');
			$.each(data,function(index,productList){

				$('#product').append('<option value="'+productList.id+'">'+productList.name+'</option');

				
			});
		});
		
	    
	    $("#addOrder").click(function(){
	    	var product=$("#product option:selected").val();
	    	

	    	if(product!=0){
	    		var client=$("#client option:selected").val();
	    		if(client==0)
			        {
			        	$("#myTable").append('<tr><td value="'+$("#client option:selected").val()+'"> --</td> <td value="'+$("#product option:selected").val()+'">'+$("#product option:selected").text()+'</td> <td value="'+$("#sq_feet").val()+'">'+$("#sq_feet").val()+'</td><td name="price" value="'+$("#sq_feet_rate").val()+'">'+$("#sq_feet_rate").val()+'</td> <td><a href="javascript:void(0);" class="remCF"><i class="fa fa-times" aria-hidden="true"></i></a></td> </tr>');
			        }
			    else{

			    	$("#myTable").append('<tr><td value="'+$("#client option:selected").val()+'">'+$("#client option:selected").text()+'</td> <td value="'+$("#product option:selected").val()+'">'+$("#product option:selected").text()+'</td> <td value="'+$("#sq_feet").val()+'">'+$("#sq_feet").val()+'</td><td name="price" value="'+$("#sq_feet_rate").val()+'">'+$("#sq_feet_rate").val()+'</td> <td><a href="javascript:void(0);" class="remCF"><i class="fa fa-times" aria-hidden="true"></i></a></td> </tr>');
			    }

	        var grandTotal = 0;
		    $("#myTable").find('td[name^="price"]').each(function () {
		        grandTotal += +$(this).text();
		    });
		    $("#total").text("Total: "+grandTotal.toFixed(2));


			$("table tr").each(function(i, v){
			    orders[i] = Array();
			    $(this).children('td').each(function(ii, vv){
			        
			        orders[i][ii]= this.getAttribute("value");

			    }); 
			})

			}
	    });

		    $("#myTable").on('click','.remCF',function(){
		        $(this).parent().parent().remove();
		    });

		$("#submit").click(function(){

			 $.post("{{ route('newOrder.store') }}", 
			 	{  order: orders,
		           '_token': $('meta[name=csrf-token]').attr('content')
		       },
	           function(data, status){
	           	
	           	window.location.href = "/allOrders";
			   
		    });

	       
	    });
	});
</script>       
@endsection





