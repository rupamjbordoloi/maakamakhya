@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
		<section class="content">
		<div class="col-md-10">
		  <div class="box">
		  	<div class="box-header">
              <div class="col-md-offset-4"><h3 class="box-title">Register New User</h3></div><hr>
            </div>
		  	<form method="post" action="{{ route('Register.store') }}">
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
					      <input type="text" class="form-control myInput" id="name" placeholder="Enter name" name="name">
					      @if ($errors->has('name'))
		                    <span class="help-block">
		                        <strong>{{ $errors->first('name') }}</strong>
		                    </span>
		                  @endif
					    </div>

					    <div class="form-group">
					      <label for="email">Email:</label>
					      <input type="email" class="form-control myInput" id="email" placeholder="Enter email" name="email">
					      @if ($errors->has('email'))
		                    <span class="help-block">
		                        <strong>{{ $errors->first('email') }}</strong>
		                    </span>
		                  @endif
					    </div>

					    <div class="form-group">
					      <label for="password">Password:</label>
					      <input type="password" class="form-control myInput" id="password" placeholder="Enter password" name="password">
					      @if ($errors->has('password'))
		                    <span class="help-block">
		                        <strong>{{ $errors->first('password') }}</strong>
		                    </span>
		                  @endif
					    </div>

					    <div class="form-group">
					      <label for="password_confirmation">Confirm Password:</label>
					      <input type="password" class="form-control myInput" id="password_confirmation" placeholder="Confirm password" name="password_confirmation">
					      @if ($errors->has('password_confirmation'))
		                    <span class="help-block">
		                        <strong>{{ $errors->first('password confirmation') }}</strong>
		                    </span>
		                  @endif
					    </div>

					    <div class="form-group" id="user_type" name="user_type">
					      <label>User Type:</label>
					      <select class="form-control myInput">
					      @foreach($roles as $role)
					      <option value="{{$role->id}}">{{$role->name}}</option>
					      @endforeach
					      </select>
					      @if ($errors->has('user_type'))
		                    <span class="help-block">
		                        <strong>{{ $errors->first('user_type') }}</strong>
		                    </span>
		                  @endif
					    </div>

					    <input type="hidden" name="selected_user_type" id="selected_user_type">

					    <div class="form-group">
					      <label for="phone_no">Phone No:</label>
					      <input type="number" class="form-control myInput" id="phone_no" placeholder="Enter phone no" name="phone_no">
					      @if ($errors->has('phone_no'))
		                    <span class="help-block">
		                        <strong>{{ $errors->first('phone_no') }}</strong>
		                    </span>
		                  @endif
					    </div>

					    <div class="form-group" >
					      <label for="address">Address:</label>
					      <input type="text" class="form-control myInput" id="address" placeholder="Enter address" name="address">
					      @if ($errors->has('address'))
		                    <span class="help-block">
		                        <strong>{{ $errors->first('address') }}</strong>
		                    </span>
		                  @endif
					    </div>

					    <div class="form-group">
					    <input class="btn btn-primary" type="submit" value="Create New User">
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
<script type="text/javascript">
$(document).ready(function(){
	
     $("#user_type").change(function(){
        var user_type= $('#user_type').find(":selected").val();
        document.getElementById("selected_user_type").value=user_type;
     
      });

    

    
});
</script>
@endsection
