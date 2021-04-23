@extends('admin.admin', ['title' => 'Edit users'])

@section('content')
    <h1 style="margin-top: 20px; margin-bottom: 20px;" class="mb-4">Edit users</h1>
    <form method="post" action="{{ route('admin.user.update', ['user' => $user->id]) }}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label style="margin-bottom: 10px;">Name</label>
                    <input type="text" class="form-control" name="firstname" placeholder="Name"
                        required maxlength="255" value="{{ old('firstname') ?? $user->firstname ?? '' }}" disabled>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label style="margin-bottom: 10px;">Surname</label>
                    <input type="text" class="form-control" name="lastname" placeholder="Surname"
                        required maxlength="255" value="{{ old('lastname') ?? $user->lastname ?? '' }}" disabled>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label style="margin-bottom: 10px; margin-top: 20px;">Email</label>
                    <input type="email" class="form-control" name="email"
                        required maxlength="255" value="{{ old('email') ?? $user->email ?? '' }}" disabled>
                </div>
            </div>
            <div class="col">
                <label style="margin-bottom: 10px; margin-top: 20px;">Role</label>
                <select name="is_admin" class="form-select">
                    <option selected disabled>Select role</option>
                    <option value="0">User</option>
                    <option value="1">Admin</option>
                </select>
            </div>
        </div>
        <div style="margin-top: 20px;" class="form-group">
            <button  type="submit" class="btn btn-success">Save</button>
            <a class="btn btn-primary" href="{{ route('admin.user.index') }}">Back to users</a>
        </div>
    </form>
@endsection