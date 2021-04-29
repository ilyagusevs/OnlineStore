@extends('admin.admin')

@section('content')
    @if(Session::has('success'))
        <div style="margin-top: 20px;" class="alert alert-success" role="alert">
 	        {{Session::get('success')}}
        </div>
    @endif
    <h1 style="margin-top: 30px; margin-bottom: 20px;">View product</h1>
    <div class="row">
        <div class="col-md-6">
            <p><strong>Title:</strong> {{ $product->title }}</p>
            <p><strong>Slug:</strong> {{ $product->slug }}</p>
            <p><strong>Brand:</strong> {{ $product->brand->brand }}</p>
            <p><strong>Price:</strong> &euro; {{ $product->new_price }}</p>
            <div class="sizes" style="display: flex;">
                <strong class="size-title" style="margin-bottom: 15px;">Sizes: &nbsp;</strong>
                @foreach($product->sizes as $size)
                    <p>{{ $size['size'] }} &nbsp;</p>
                @endforeach
            </div>
            <p><strong>Category:</strong> {{ $product->category->title }}</p>

        </div>
        <p><strong>Description: </strong></p>
            @isset($product->description)
                <p>{{ $product->description }}</p>
            @else
                <p>No description</p>
            @endisset
        <p><strong>Images: </strong></p>
        @foreach($product->images as $img)
            <img style="width: 264px; margin-bottom: 30px;" src="/css/productImages/{{$img['img']}}" alt="{{$product->title}}">
        @endforeach
    </div>
    <div class="row">
        <div class="col-12">
            <a href="{{ route('admin.product.edit', ['product' => $product->id]) }}"
               class="btn btn-success">
                Edit product info
            </a>
            <form method="post" class="d-inline" onsubmit="return confirm('Delete this product?')"
                  action="{{ route('admin.product.destroy', ['product' => $product->id]) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    Delete product
                </button>
            </form>
            <a class="btn btn-primary" href="{{ url('/admin/add-images/'.$product->id) }}">
                Edit image(s)
            </a>
            <a class="btn btn-secondary" href="{{ url('/admin/add-sizes/'.$product->id) }}">
                Edit size(s)
            </a>
        </div>
    </div>

@endsection
