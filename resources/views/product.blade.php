@extends('layouts.navbar-footer')

@section('title', $item->title)

@section('custom_js')
    <script src="/js/product.js"></script>
@endsection

@section('content')
    <head>
        <link rel="stylesheet" href="/css/product.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous"/>
    </head>   

    <!-- Product Details -->

    <div class="product_details">
        <div class="container">
            <div class="row details_row">
                <!-- Product Image -->
                <div class="col-lg-6">
                    <div class="details_image">
                        @php
                            $image = '';
                            if(count($item->images) > 0){
                                $image = $item->images[0]['img'];
                            } else {
                                $image = 'no_image.png';
                            }
                        @endphp
                        <div class="details_image_large"><img src="/css/productImages/{{$image}}" alt="{{$item->title}}" id="currentImage"></div>
                        <div class="details_image_thumbnails">
                            @if($image == 'no_image.png')
                            @else
                                @foreach($item->images as $img)
                                    @if($loop->first)
                                        <div class="details_image_thumbnail active" data-image="/css/productImages/{{$img['img']}}"><img src="/css/productImages/{{$img['img']}}" alt="{{$item->title}}"></div>
                                    @else
                                        <div class="details_image_thumbnail" data-image="/css/productImages/{{$img['img']}}"><img src="/css/productImages/{{$img['img']}}" alt="{{$item->title}}"></div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <!-- Product Content -->
                <div class="col-lg-6">
                <form action="{{route('cart-add', ['id' => $item->id])}}" method="POST">
                @csrf
                    <div class="details_content">
                        <div class="details_name" data-id="{{$item->id}}"><h2>{{ $item->brand->title }} {{$item->title}}</h2></div>
                        <div class="price">
                            @if($item->new_price != $item->old_price)
                                <div class="oldprice">&euro; {{ number_format($item->old_price, 2, '.', '') }}</div>
                                <div class="newprice">&euro; {{ number_format($item->new_price, 2, '.', '') }}</div>
                            @else
                                <div class="oldprice1">&euro; {{ number_format($item->old_price, 2, '.', '') }}</div>
                            @endif
                        </div>
                        <!-- In Stock -->
                        <div class="in_stock_container">
                            <div class="availability">Availability : </div>
                                @if($item->in_stock)
                                    <a class="instock" style="color: green">In Stock</a>
                                @else
                                    <a class="outofstock" style="color: red">Out of stock</a>
                                @endif
                        </div>
                        <div class="details_text">
                            <p>{{$item->description}}</p>
                        </div>

                        </div>
                            @if($item->in_stock)
                                <button style="margin-top: 20px;" type="submit" class="btn btn-success">Add to cart</button>  
                            @else
                                <button style="margin-top: 20px;" type="submit" class="btn btn-success" disabled>Add to cart</button>  
                            @endif
                        @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection