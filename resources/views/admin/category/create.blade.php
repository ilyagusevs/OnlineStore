@extends('admin.admin')

@section('content')

<h1 style="margin-top: 30px; margin-bottom: 30px;" >Adding new category</h1>
    <form method="post" action="{{ route('admin.category.store') }}" enctype="multipart/form-data">
        @csrf
        @include('admin.category.part.form')
    </form>
@endsection
