@extends('layouts.navbar-footer')

@section('title', 'JUST SPORT')

<link rel="stylesheet" href="/css/dashboard.css">

@section('content')
<div style="display: flex;" class="container">
	<div class="row">
		<div class="col-md-4">
			<div class="products">
				<a href="{{route('user.dashboard')}}"><i class="fas fa-user-circle fa-lg"></i> Dashboard </a>
				<hr class="my-4"> 
				<a href="{{route('user.edit-profile')}}"><i class="fas fa-edit fa-lg"></i> Edit Account</a>
				<hr class="my-4"> 
				<a href="{{route('user.change-password')}}"><i class="fas fa-lock fa-lg"></i> Change Password</a>
				<hr class="my-4">
			</div>
		</div>
	</div>
	<div class="products">
		<div class="col">
			@yield('profile')
		</div>
	</div>
</div>
@endsection
