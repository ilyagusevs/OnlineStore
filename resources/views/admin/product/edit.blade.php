@extends('admin.admin')

@section('content')

<h1 style="margin-top: 30px; margin-bottom: 20px;">Update product</h1>
<form method="post" enctype="multipart/form-data"
          action="{{ route('admin.product.update', ['product' => $product->id]) }}">
        @method('PUT')
        @include('admin.product.part.edit-form')
        
</form>

@endsection
