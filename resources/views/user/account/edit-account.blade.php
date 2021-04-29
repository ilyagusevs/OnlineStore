@extends('user.account.account-layout')
@section('profile')
@if(Session::has('error'))
        <div style="margin-top: 30px; margin-bottom: 20px;" class="alert alert-danger" role="alert">
 	        {{Session::get('errors')->first()}}
        </div>
    @endif
    @if(Session::has('success'))
        <div style="margin-top: 20px;" class="alert alert-success" role="alert">
 	        {{Session::get('success')}}
        </div>
    @endif
 <div class="card">
	<div class="card-header">Update Profile</div>
	<div class="card-body">
		<form action="{{route('user.update-profile')}}"" id="edit-profile_form" method="post">
			@csrf
			@method('PUT')
			 <div class="form-group">
			    <label for="first_name">First Name</label>
			    <input type="text" name="firstname" value="{{(old('firstname'))?old('firstname'):$user->firstname}}"  class="form-control" id="firstname"  placeholder="Enter first name">
        	   @if($errors->any('firstname'))
				<span class="text-danger">{{$errors->first('firstname')}}</span>
			   @endif
			  </div>
			  <div class="form-group ">
			    <label for="last_name">Last Name</label>
			    <input type="text" value="{{(old('lastname'))?old('lastname'):$user->lastname}}"  name="lastname" class="form-control" id="lastname" placeholder="Enter last name">
          	   @if($errors->any('lastname'))
				<span class="text-danger">{{$errors->first('lastname')}}</span>
			   @endif
			  </div>
              <div class="form-group ">
			    <label for="last_name">Email</label>
			    <input type="text" value="{{(old('email'))?old('email'):$user->email}}"  name="email" class="form-control" id="email" placeholder="Enter last name">
          	   @if($errors->any('email'))
				<span class="text-danger">{{$errors->first('email')}}</span>
			   @endif
			  </div>
	
		    <button type="submit" class="btn btn-primary">Update</button>
		</form>

	</div>

</div>

@endsection