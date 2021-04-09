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
            <p><strong>Slug:</strong> {{ $product->alias }}</p>
            <p><strong>Brand:</strong> {{ $product->brand->title }}</p>
            <p><strong>Category:</strong> {{ $product->category->title }}</p>

        </div>
        <div class="col-md-6">
            @php
                $image = '';
                if(count($product->images) > 0){
                    $image = $product->images[0]['img'];
                }else{
                    $image = 'no_image.png';
                }
            @endphp  
        </div>
        @foreach($product->images as $img)
            <img style="width: 264px;" src="/css/productImages/{{$img['img']}}" alt="{{$product->title}}">
        @endforeach
    </div>
    <div class="row">
        <div class="col-12">
            <p style="margin-top: 20px;"><strong>Description: </strong></p>
            @isset($product->description)
                <p>{{ $product->description }}</p>
            @else
                <p>No description</p>
            @endisset
            <a href="{{ route('admin.product.edit', ['product' => $product->id]) }}"
               class="btn btn-success">
                Edit product
            </a>
            <form method="post" class="d-inline" onsubmit="return confirm('Delete this product?')"
                  action="{{ route('admin.product.destroy', ['product' => $product->id]) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">
                    Delete product
                </button>
            </form>
        </div>
    </div>
@endsection
