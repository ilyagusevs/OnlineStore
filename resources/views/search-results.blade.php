@extends('layouts.navbar-footer')

@section('title', 'Search results')

@section('content')
    <head>
        <link rel="stylesheet" href="/css/products.css">
    </head>   


    <div class="products">
        <div class="container">
            <h1>Search results</h1>
            <div style="margin-top: 30px; margin-bottom: 30px;"class="results">Showing <span>{{$products->count()}}</span> results for '{{ request()->input('query') }}'</div>
            <div class="row">
                <div class="col">
                    <div class="product_grid">
                        @foreach($products as $product)
                            @php
                                $image = '';
                                if(count($product->images) > 0){
                                    $image = $product->images[0]['img'];
                                }else{
                                    $image = 'no_image.png';
                                }
                            @endphp
                           <div class="product">
                                <div class="product_image">
                                    <a href="{{route('show-product',[$product->category['slug'], $product->slug])}}"><img src="/css/productImages/{{$image}}" alt="{{$product->title}}"></a>
                                    <div class="product_content">
                                        <div class="product_title">{{ $product->brand->title }} {{$product->title}}</div>
                                            <div class="prices">
                                            @if($product->new_price != $product->old_price)
                                                <div class="product_price" >&euro; {{ number_format($product->old_price, 2, '.', '') }}</div>
                                                <div class="product_new_price">&euro; {{ number_format($product->new_price, 2, '.', '') }}</div>
                                            @else
                                                <div class="product_price1">&euro; {{ number_format($product->old_price, 2, '.', '') }}</div>
                                            @endif    
                                        </div>  
                                    </div>    
                                </div>
                           </div>
                        @endforeach                      
                    </div>
                </div>
                {{ $products->appends(request()->query())->links('pagination.pagination') }}           
            </div>
        </div>
    </div>
@endsection
