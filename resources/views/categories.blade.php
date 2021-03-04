@extends('layouts.navbar-footer')

@section('title', $categ->title)

@section('content')
    <head>
        <link rel="stylesheet" href="/css/home.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous"/>
    </head>   

    <div class="home-title"><h1>{{$categ->title}}</h1></div>

    <div class="products">
        <div class="results">Showing <span>{{$categ->products->count()}}</span> results</div>
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="product_grid">
                        @foreach($categ->products as $product)
                            @php
                                $image = '';
                                if(count($product->images) > 0){
                                    $image = $product->images[0]['img'];
                                }else{
                                    $image = 'no_image.png';
                                }
                            @endphp
                           <div class="product">
                                <div class="product_image"><img src="css/productImages/{{$image}}" alt="{{$product->title}}">
                                    <div class="product_content">
                                        <div class="product_title"><a href="{{route('showProduct', ['category', $product->id])}}">{{$product->title}}</a></div>
                                        @if($product->new_price != null)
                                            <div style="text-decoration: line-through">&euro; {{$product->price}}</div>
                                            <div class="product_price">&euro; {{$product->new_price}}</div>
                                        @else
                                            <div class="product_price">&euro; {{$product->price}}</div>
                                        @endif      
                                    </div>    
                                </div>
                           </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
   
@endsection