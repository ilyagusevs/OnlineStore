@extends('admin.admin')

@section('content')
    @if(Session::has('errors'))
        <div style="margin-top: 30px; margin-bottom: 20px;" class="alert alert-danger" role="alert">
 	        {{Session::get('errors')->first()}}
        </div>
    @endif
    <h1 style="margin-top: 20px;">All categories</h1>
        <a style="margin-top: 20px; margin-bottom: 30px;" class="btn btn-success mb-4" role="button" href="{{ route('admin.category.create')}}">Add category</a>
    <table class="table table-bordered">
        <tr>
            <th width="40%">Title</th>
            <th width="10%">Actions</th>
        </tr>
        @include('admin.category.part.tree', ['level' => -1, 'parent' => 0])
    </table>
@endsection
