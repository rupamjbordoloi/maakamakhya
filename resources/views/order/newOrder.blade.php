@extends('layouts.app')

@section('content')

<style type="text/css">
	
	.form-group{
		margin:16px;
	}
	select{

		width:330px;

	}

	#client{

		width: 210px;

	}
	#tax{

		width: 210px;

	}
	#sq_feet{

		width: 210px;

	}
	#product{
		position: relative;
		left:9px;
		width:210px;
	}
	#date{

		width: 210px;

	}
</style>

<div class="container">    
	<section class="content">		
		<div class="row">
<!-- 		  	<div class="col-md-12"> -->
		  		<!--container for added product-->		  

            	<div class="col-md-10">            		
            		<div class="box">	  	
	            		<div class="box-body">
	            			<form class="form-inline">
						    <div class="form-group col-md-6">
							  <label>Select Client:</label>
						      <select class="form-control myInput" id="client" name="client">
						      <option value="0">--select client--</option>
						      @foreach($clients as $client)
						      <option value="{{$client->id}}">{{$client->name}}</option>
						      @endforeach
						      </select>
						      <a href="/newClient" target="_blank">
						      	New Client+
						      </a>
				    	    </div>

				    	    <div class="form-group">
							  <label>Select Product:</label>
						      <select class="form-control myInput" id="product" name="product">
						      </select>
				    	    </div>

						    <div class="form-group col-md-6">
							  <label>Select Tax:</label>
						      <select class="form-control myInput" id="tax" name="tax">
						      <option value="0">--select tax--</option>
						      @foreach($taxes as $tax)
						      <option value="{{$tax->id}}">{{$tax->name}}:{{$tax->percent}}%</option>
						      @endforeach
						      </select>
				    	    </div>


				    	    <div class="form-group">
							  <label>Date : </label>
						      <input type="date" class="form-control myInput" id="date" name="date" required>
				    	    </div><br>


				    	    <div class="form-group col-md-6">
							  <label>Square feet:</label>
						      <input type="number" class="form-control myInput" id="sq_feet" name="sq_feet" required>
				    	    </div>

				    	    <div class="form-group">
							  <label>Square feet rate:</label>
						      <input type="number" class="form-control myInput" id="sq_feet_rate" name="sq_feet_rate" required>
				    	    </div>

				    	    <br>
						    <div class="form-group">
						    <input type="button" class="btn btn-primary" id="addOrder" value="Add Order"> 
						    </div>
						    </form>				    
						</div>
			    	</div>			            
            	</div>


		</div><!--row close-->

		<div class="row">

				  	<div class="col-md-10">
					    <div class="box" id="dynamicBox">
						  <div class="box-body">
						  	<form id="tableForm" method="post" action="{{ route('newOrder.store') }}">
							  	<meta name="csrf-token" content="{{ Session::token() }}"> 
							  	<table class="table table-striped table-hover" id="myTable" name="myTable[]">
							  		<thead>
						                <tr>
						                  <th>Client</th>
						                  <th>Product</th>
						                  <th>Square Feet</th>
						                  <th>Tax</th>
						                  <th>Date</th>
						                  <th>Price</th>
						                  <th> </th> 
						                </tr>
						            </thead>
						            <tbody></tbody>
							  	</table>
							  	<hr>
							  	<div class="form-group">
							  		<table class="table table-striped table-hover col-md-offset-10 col-md-2">
							  			<tbody>
							  				<tr class="col-md-2">
							  					<td id="total">Total: <strong>00.00</strong></td>
							  				</tr>
							  			</tbody>
							  		</table>
							  	</div>
						  		<div class="form-group">
									<input type="button" class="btn btn-primary" id="submit" value="submit">
								</div>
							</form>
						   </div>
						<!-- </div> -->
				  	</div>
			  		             	
			  	</div>

		</div>
	</section><!--section close-->   
</div><!--container close-->

<script>



	$("#tax").on('change',function(e){
		var tax_id=e.target.value;
		
		$.get('/getTax?tax_id='+tax_id,function(data){

			$.each(data,function(index,percentList){

				tax=percentList.percent;

				var sq = $('#sq_feet').val();
		    	var r=parseFloat(rate);
		    	var di=parseFloat(sq);
		    	var t=parseFloat(tax);
		    	var x=sq*r*(t)/100;
		   		$('#sq_feet_rate').val(r+x);

				
			});
			
		});

	});

	function find_total(){

			var total=[];
			var t=0;
			$("table tr td:nth-child(6)").each(function(){

				total.push( $(this).text() );

			});
			for(var i=0;i<total.length;i++)
				t=t+parseFloat(total[i]);
			return t;
	}
	function price_update(){

		$('#myTable').find('tr').click( function(){
		  
		  var sf=$(this).find('td:nth-child(3) input').val();
		  var s=parseFloat(sf);
		  var r=parseFloat(rate);
		  var t=parseFloat(tax);
		  var x=s*r*(t)/100;
		 
		  $(this).find('td:nth-child(6)').text(r+x);
		  $('#total').text("Total: "+find_total().toFixed(2));
		});
	}


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
    	var r=parseInt(rate);
    	var di=parseInt(dInput);
    	var t=parseInt(tax);
    	var x=di*r*(t)/100;
   		$('#sq_feet_rate').val(r+x);
	});


var orders = Array();	

	$(document).ready(function(){

		$("#dynamicBox").hide();
	    
	    $("#addOrder").click(function(){

	    	var product=$("#product option:selected").val();
	    	var tax=$("#tax option:selected").val();
	    	var date=$("#date").val();

	    	if($("#client").val()>0)
	    		$("#client").attr("disabled","true");
	    	

	    	if(product!=0 && tax!=0 && date!=""){
	    		var client=$("#client option:selected").val();
	    		
			    if(client!=0){
			    	$("#dynamicBox").show();

			    	$("#myTable").append('<tr><td value="'+$("#client option:selected").val()+'">'+$("#client option:selected").text()+'</td> <td value="'+$("#product option:selected").val()+'">'+$("#product option:selected").text()+'</td> <td value="'+$("#sq_feet").val()+'"><input type="number" onclick="price_update();" value="'+$("#sq_feet").val()+'"></td> <td value="'+$("#tax option:selected").val()+'">'+$("#tax option:selected").text()+'</td> <td value="'+$("#date").val()+'">'+$("#date").val()+'</td> <td name="price" value="'+$("#sq_feet_rate").val()+'">'+$("#sq_feet_rate").val()+'</td><td><a href="javascript:void(0);" class="remCF"><i class="fa fa-times" aria-hidden="true"></i></a></td> </tr>');

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

			var items=[];

			$("table tr td:nth-child(3) input").each(function(){

				items.push( $(this).val() );

			});

			var x=1;
			
			$("table tr td:nth-child(3)").each(function(){

				orders[x][2]=items[x-1];
				x++;
			});

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





