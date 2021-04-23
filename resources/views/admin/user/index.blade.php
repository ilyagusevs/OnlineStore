@extends('admin.admin', ['title' => 'All users'])

@section('content')
    @if(Session::has('success'))
        <div style="margin-top: 20px;" class="alert alert-success" role="alert">
 	        {{Session::get('success')}}
        </div>
    @endif
    <h1 style="margin-top: 20px; margin-bottom: 20px;" class="mb-4">All users</h1>

    <table class="table table-bordered">
        <tr>
            <th>#</th>
            <th width="25%">Registration date</th>
            <th width="25%">Name, Surname</th>
            <th width="25%">Email</th>
            <th width="20%">Quantity of orders</th>
            <th width="20%">Role</th>
            <th><i class="fas fa-edit"></i></th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->created_at->format('d.m.Y H:i') }}</td>
                <td>{{ $user->firstname }} {{ $user->lastname }}</td>
                <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                <td>{{ $user->orders->count() }}</td>
                @if( $user->is_admin == 1  )
                    <td>Admin</td>
                @else
                    <td>User</td>
                @endif
                <td>
                    <a href="{{ route('admin.user.edit', ['user' => $user->id]) }}">
                        <i class="far fa-edit"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $users->links('pagination.pagination') }}
@endsection