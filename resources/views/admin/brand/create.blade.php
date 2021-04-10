@extends('admin.admin')

@section('content')

<h1 style="margin-top: 30px; margin-bottom: 30px;" >Adding new brand</h1>
    <form method="post" action="{{ route('admin.brand.store') }}" enctype="multipart/form-data">
        @csrf
        @include('admin.brand.part.form')
    </form>
@endsection
