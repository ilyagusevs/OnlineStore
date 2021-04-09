@extends('admin.admin')

@section('content')

<h1 style="margin-top: 30px; margin-bottom: 30px;" >Category editing</h1>
    <form method="post" enctype="multipart/form-data"
          action="{{ route('admin.category.update', ['category' => $category->id]) }}">
        @method('PUT')
        @include('admin.category.part.form')
    </form>
@endsection
