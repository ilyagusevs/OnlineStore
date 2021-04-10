@extends('admin.admin')

@section('content')

<h1 style="margin-top: 30px; margin-bottom: 30px;" >Brand editing</h1>
    <form method="post" action="{{ route('admin.brand.update', ['brand' => $brand->id]) }}" enctype="multipart/form-data">
        @method('PUT')
        @include('admin.brand.part.form')
    </form>
@endsection
