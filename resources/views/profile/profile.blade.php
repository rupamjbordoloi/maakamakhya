@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
		<section class="content">
		  <div class="box">
				<div class="container">
			    	<div class="row">
				    	 <div class="box-body">
					        	<div class="col-md-8 col-md-offset-2">
					        		<img src="/images/{{$user->image}}" style="width: 150px;height: 150px;float: left;border-radius: 50%;margin-right: 25px">
									<h2>{{$user->name}}</h2>
								<!--Update profile image -->
									{!! Form::open(['method'=>'post','route'=>['profile.store'],'enctype'=>'multipart/form-data']) !!}
										
										<div class="form-group">
											<label>Update profile picture</label>
											<div class="row">
												<input type="file" name="profile_image" class="col-md-4">
												<button type="submit" class="btn btn-primary btn-sm">Update</button>
											</div>
										</div>

									{!! Form::close() !!}
								<!--update image from close-->
							    </div>
						  </div><!--box-body close-->
					</div><!--row close-->
				</div><!--container close-->
			</div><!--box close-->
		</section><!--section close-->
    </div><!--row close-->
</div><!--container close-->
@endsection
