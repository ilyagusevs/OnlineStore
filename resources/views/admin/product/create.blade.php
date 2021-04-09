@extends('admin.admin')

@section('content')

<h1 style="margin-top: 30px; margin-bottom: 20px;">Add new product</h1>
    <form method="post" action="{{ route('admin.product.store') }}" enctype="multipart/form-data">
        @include('admin.product.part.form')
    </form>

@endsection
