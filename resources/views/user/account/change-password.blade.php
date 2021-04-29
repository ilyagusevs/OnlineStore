@extends('user.account.account-layout')
@section('profile')
    @if(Session::has('errors'))
        <div style="margin-top: 30px; margin-bottom: 20px;" class="alert alert-danger" role="alert">
 	        {{Session::get('errors')->first()}}
        </div>
    @endif
    @if(Session::has('error'))
        <div style="margin-top: 30px; margin-bottom: 20px;" class="alert alert-danger" role="alert">
 	        {{Session::get('error')}}
        </div>
    @endif
    @if(Session::has('success'))
        <div style="margin-top: 20px;" class="alert alert-success" role="alert">
 	        {{Session::get('success')}}
        </div>
    @endif
 <div class="card">
    <div class="card-header">
        Change password
    </div>
    <div class="card-body">
	    <form action="{{ route('user.update-password') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="current_password">Current Password:</label>
                <input type="password" class="form-control" id="current_password" name="current_password">
            </div>
            <div class="form-group">
                <label for="new_password">New Password:</label>
                <input type="password" class="form-control" id="new_password" name="new_password">
            </div>
            <div class="form-group">
                <label for="new_password_confirmation">Confirm New Password:</label>
                <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation">
            </div>
            <button class="btn btn-success" type="submit">Change Password</button>
        </form>
    </div>
</div>

@endsection