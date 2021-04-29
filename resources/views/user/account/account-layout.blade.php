@extends('layouts.navbar-footer')

@section('title', 'JUST SPORT')

@section('content')
    <div class="container">
		<div class="row">
			<div class="col-md-4">
				<ul class="list-group profile-nav">
				<li class="list-group-item"><a href="{{route('user.dashboard')}}">Dashboard </a></li>
				<li class="list-group-item"><a href="{{route('user.edit-profile')}}">Edit Profile</a></li>
				<li class="list-group-item"><a href="{{route('user.change-password')}}"">Change Password</a></li>
				</ul>
			</div>
			<div class="col-md-8">
				@yield('profile')
			</div>
		</div>
    </div>
@endsection