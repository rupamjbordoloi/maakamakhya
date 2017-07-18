@extends('layouts.app')

@section('content')
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
<script>
	function FillBilling(f) {
	  if(f.billingtoo.checked == true) {
	    f.saddress.value = f.address.value;
	    f.szipCode.value = f.zipCode.value;
	    f.scity.value = f.city.value;
	  }
}</script>

@endsection
