@extends('user.account.account-layout')
@section('profile')
	@if(Session::has('errors'))
        <div class="alert alert-danger" role="alert">
 	        {{Session::get('errors')->first()}}
        </div>
    @endif
	
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
 	        {{Session::get('success')}}
        </div>
    @endif
	<div class="card-body">
		<form action="{{route('user.update-profile')}}"" id="edit-profile_form" method="post">
			@csrf
			@method('PUT')
			 <div class="form-group">
			    <label for="first_name">First Name</label>
			    <input type="text" name="firstname" value="{{(old('firstname'))?old('firstname'):$user->firstname}}"  class="form-control" id="firstname"  placeholder="Enter first name">
			  </div>
			  <div class="form-group ">
			    <label for="last_name">Last Name</label>
			    <input type="text" value="{{(old('lastname'))?old('lastname'):$user->lastname}}"  name="lastname" class="form-control" id="lastname" placeholder="Enter last name">
			  </div>
              <div class="form-group ">
			    <label for="last_name">Email</label>
			    <input type="text" value="{{(old('email'))?old('email'):$user->email}}"  name="email" class="form-control" id="email" placeholder="Enter last name">
			  </div>
		    <button type="submit" class="btn btn-success">Update Account</button>
		</form>
	</div>
@endsection