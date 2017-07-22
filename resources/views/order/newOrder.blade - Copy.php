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
						      <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>
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

<!--modal-->
<div id="myModal" class="modal fade" role="dialog">
 <div class="modal-dialog">
 <div class="modal-content"
<div class="container">
    <div class="row">
		<section class="content">
		 <div class="col-md-10">
		  <div class="box">
		    <div class="box-header">
              	  <div class="col-md-offset-4"><h3 class="box-title">Add New Client</h3></div><hr>
	        </div>
		  	<form method="post" action="{{ route('newClient.store') }}">
            {!! csrf_field() !!}
            <div class="row">
            	<div class="container">
            		<div class="col-md-8">
            			@if (session()->has('successMessage'))
						<div class="alert alert-success alert-block">
							<button type="button" class="close" data-dismiss="alert">×</button>	
						        <strong>{{ session('successMessage') }}</strong>
						</div>
						@endif
						@if(session()->has('failedMessage'))
						    <div class="alert alert-danger">
						        {{ session('failedMessage') }}
						    </div>
						@endif
		            	<div class="form-group">
					      <label for="name">Name:</label>
					      <input type="text" class="form-control myInput" id="name" placeholder="Enter name" name="name" value="{!! old('name') !!}">
					      @if ($errors->has('name'))
		                    <span class="help-block">
		                        <strong>{{ $errors->first('name') }}</strong>
		                    </span>
		                  @endif
					    </div>

					    <div class="form-group row">
					    	<div class="col-md-4">
						      <label for="vat">Vat:</label>
						      <input type="text" class="form-control myInput" id="vat" placeholder="Enter vat" name="vat" value="{!! old('vat') !!}">
						      @if ($errors->has('vat'))
		                    <span class="help-block">
		                        <strong>{{ $errors->first('vat') }}</strong>
		                    </span>
		                  @endif
						    </div>
						    <div class="col-md-8">
						      <label for="companyName">Company Name:</label>
						      <input type="text" class="form-control myInput" id="companyName" placeholder="Enter company name" name="companyName" value="{!! old('companyName') !!}">
						      @if ($errors->has('companyName'))
		                    <span class="help-block">
		                        <strong>{{ $errors->first('companyName') }}</strong>
		                    </span>
		                  @endif
					    	</div>
					    </div>

					    <div class="form-group">
					      <label for="email">Email:</label>
					      <input type="email" class="form-control myInput" id="email" placeholder="Enter email" name="email" value="{!! old('email') !!}">
					      @if ($errors->has('email'))
		                    <span class="help-block">
		                        <strong>{{ $errors->first('email') }}</strong>
		                    </span>
		                  @endif
					    </div>

					    <hr>

					    <H3>Billing Address</H3>

					    <div class="form-group">
					      <label for="address">Address:</label>
					      <input type="text" class="form-control myInput" id="address" placeholder="Enter address" name="address" value="{!! old('address') !!}">
					      @if ($errors->has('address'))
		                    <span class="help-block">
		                        <strong>{{ $errors->first('address') }}</strong>
		                    </span>
		                  @endif
					    </div>

					    <div class="form-group row">
					    	<div class="col-md-4">
						      <label for="zipcode">Zip Code:</label>
						      <input type="number" class="form-control myInput" id="zipCode" placeholder="Enter zip code" name="zipCode" value="{!! old('zipCode') !!}">
						      @if ($errors->has('zipCode'))
		                    <span class="help-block">
		                        <strong>{{ $errors->first('zipCode') }}</strong>
		                    </span>
		                  @endif
						    </div>
						    <div class="col-md-8">
						      <label for="city">City:</label>
						      <input type="text" class="form-control myInput" id="city" placeholder="Enter city" name="city" value="{!! old('city') !!}">
						      @if ($errors->has('city'))
		                    <span class="help-block">
		                        <strong>{{ $errors->first('city') }}</strong>
		                    </span>
		                  @endif
					    	</div>
					    </div>

					    <H3>Shipping Address</H3>

					    <p><input type="checkbox" name="billingtoo" onclick="FillBilling(this.form)">
						<em>Check this box if Billing Address and Shipping Address are the same.</em></p>


					    <div class="form-group">
					      <label for="saddress">Address:</label>
					      <input type="text" class="form-control myInput" id="saddress" placeholder="Enter address" name="saddress" value="{!! old('saddress') !!}">
					      @if ($errors->has('saddress'))
		                    <span class="help-block">
		                        <strong>{{ $errors->first('address') }}</strong>
		                    </span>
		                  @endif
					    </div>

					    <div class="form-group row">
					    	<div class="col-md-4">
						      <label for="szipCode">Zip Code:</label>
						      <input type="number" class="form-control myInput" id="szipCode" placeholder="Enter zip code" name="szipCode" value="{!! old('szipCode') !!}">
						     @if ($errors->has('szipCode'))
		                    <span class="help-block">
		                        <strong>{{ $errors->first('zipCode') }}</strong>
		                    </span>
		                  @endif
						    </div>
						    <div class="col-md-8">
						      <label for="scity">City:</label>
						      <input type="text" class="form-control myInput" id="scity" placeholder="Enter city" name="scity" value="{!! old('scity') !!}">
						      @if ($errors->has('scity'))
		                    <span class="help-block">
		                        <strong>{{ $errors->first('city') }}</strong>
		                    </span>
		                  @endif
					    	</div>
					    </div>

					    <div class="form-group">
					      <label for="primaryNo">Primary No:</label>
					      <input type="number" class="form-control myInput" id="primaryNo" placeholder="Enter primary no" name="primaryNo" value="{!! old('primaryNo') !!}">
					      @if ($errors->has('primaryNo'))
		                    <span class="help-block">
		                        <strong>{{ $errors->first('primaryNo') }}</strong>
		                    </span>
		                  @endif
					    </div>

					    <div class="form-group">
					      <label for="secondaryNo">Secondary No:</label>
					      <input type="number" class="form-control myInput" id="secondaryNo" placeholder="Enter secondary no" name="secondaryNo" value="{!! old('secondaryNo') !!}">
					      @if ($errors->has('secondaryNo'))
		                    <span class="help-block">
		                        <strong>{{ $errors->first('secondaryNo') }}</strong>
		                    </span>
		                  @endif
					    </div>

					    <div class="form-group">
					      <label for="industry">Company Type:</label>
					      <select class="form-control myInput" id="companyType " name="companyType" value="{!! old('companyType') !!}">
					      <option value="Private Ltd Company">Private Ltd Company</option>
					      <option value="Public Ltd Company">Public Ltd Company</option>
					      <option value="Unlimited Company">Unlimited Company</option>
					      <option value="Sole proprietorship">Sole proprietorship</option>
					      <option value="Joint Hindu Family business">Joint Hindu Family business</option>
					      <option value="Partnership">Partnership</option>
					      <option value="Cooperatives">Cooperatives</option>
					      <option value="Limited Liability Partnership(LLP)">Limited Liability Partnership(LLP)</option>
					      <option value="Liaison Office">Liaison Office</option>
					      <option value="Branch Office">Branch Office</option>
					      <option value="Project Office">Project Office</option>
					      <option value="Subsidiary Company">Subsidiary Company</option>
					      </select>
					      @if ($errors->has('companyType'))
		                    <span class="help-block">
		                        <strong>{{ $errors->first('companyType') }}</strong>
		                    </span>
		                  @endif
					    </div>

					    <div class="form-group">
					      <label for="industry">Industry:</label>
					      <select class="form-control myInput" id="industry " name="industry" value="{!! old('industry') !!}">
					      @foreach($industries as $industry)
					      <option value="{{$industry->id}}">{{$industry->name}}</option>
					      @endforeach
					      </select>
					      @if ($errors->has('industry'))
		                    <span class="help-block">
		                        <strong>{{ $errors->first('industry') }}</strong>
		                    </span>
		                  @endif
					    </div>

					    <div class="form-group">
					      <label for="assignUser">Assign User:</label>
					      <select class="form-control myInput" id="assignUser " name="assignUser" value="{!! old('assignUser') !!}">
					      @foreach($users as $user)
					      <option value="{{$user->id}}">{{$user->name}}</option>
					      @endforeach 
					      </select>
					      @if ($errors->has('assignUser'))
		                    <span class="help-block">
		                        <strong>{{ $errors->first('assignUser') }}</strong>
		                    </span>
		                  @endif
					    </div>

					    <div class="form-group">
					    <input class="btn btn-primary" type="submit" value="Create New Client">
					    </div>


					</div>
			    </div>
			</div>
            </form>
		  </div><!--box close-->
		  </div>
		</section><!--section close-->
    </div><!--row close-->
</div><!--container close-->
</div>
</div>
</div>
<script>
	function FillBilling(f) {
	  if(f.billingtoo.checked == true) {
	    f.saddress.value = f.address.value;
	    f.szipCode.value = f.zipCode.value;
	    f.scity.value = f.city.value;
	  }
}</script>
<!--modal close-->

<script>



	$("#tax").on('change',function(e){
		var tax_id=e.target.value;
		
		$.get('/getTax?tax_id='+tax_id,function(data){

			$.each(data,function(index,percentList){

				tax=percentList.percent;

				var sq = $('#sq_feet').val();
		    	var r=parseFloat(rate);
		    	var sq=parseFloat(sq);
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
		  $(this).find('td:nth-child(6)').attr('value',r+x);
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





