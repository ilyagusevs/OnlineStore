@extends('layouts.navbar-footer')

@section('title', $product->title)

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
                            if(count($product->images) > 0){
                                $image = $product->images[0]['img'];
                            } else {
                                $image = 'no_image.png';
                            }
                        @endphp
                        <div class="details_image_large"><img src="/css/productImages/{{$image}}" alt="{{$product->title}}" id="currentImage"></div>
                        <div class="details_image_thumbnails">
                            @if($image == 'no_image.png')
                            @else
                                @foreach($product->images as $img)
                                    @if($loop->first)
                                        <div class="details_image_thumbnail active" data-image="/css/productImages/{{$img['img']}}"><img src="/css/productImages/{{$img['img']}}" alt="{{$product->title}}"></div>
                                    @else
                                        <div class="details_image_thumbnail" data-image="/css/productImages/{{$img['img']}}"><img src="/css/productImages/{{$img['img']}}" alt="{{$product->title}}"></div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <!-- Product Content -->
                <div class="col-lg-6">
                    <form action="{{route('cart-add', ['id' => $product->id])}}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <input type="hidden" name="cart_id" value="427">
                            <div class="details_content">
                                <div class="details_name" data-id="{{$product->id}}"><h2>{{ $product->brand->title }} {{$product['title']}}</h2></div>
                                <div class="price">
                                    @if($product->new_price != $product->old_price)
                                        <div class="oldprice">&euro; {{ number_format($product->old_price, 2, '.', '') }}</div>
                                        <div class="newprice">&euro; {{ number_format($product->new_price, 2, '.', '') }}</div>
                                    @else
                                        <div class="oldprice1">&euro; {{ number_format($product->old_price, 2, '.', '') }}</div>
                                    @endif
                                </div>
                            <!-- In Stock -->
                                <div class="in_stock_container">
                                    <div class="availability">Availability : </div>
                                        @if($product->in_stock)
                                            <a class="instock" style="color: green">In Stock</a>
                                        @else
                                            <a class="outofstock" style="color: red">Out of stock</a>
                                        @endif
                                </div>
                                <div>
                                <div class="select-size">
                                    <select class="selectpicker" name="size" product-id="{{ $product->id }}" oninvalid="this.setCustomValidity('Please select a size')" required>
                                        <option value="" disabled selected>Select size</option>
                                        @foreach($product['sizes'] as $size)
                                            <option value="{{$size['size']}}">{{ $size['size'] }}</option>
                                        @endforeach    
                                    </select>
                                </div>
                                </div>
                                <div class="details_text">
                                    <p>{{$product->description}}</p>
                                </div>
                                @if($product->in_stock)
                                    <button style="margin-top: 20px;" type="submit" class="btn btn-success">Add to cart</button>  
                                @else
                                    <button style="margin-top: 20px;" type="submit" class="btn btn-success" disabled>Add to cart</button>  
                                @endif
                                
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection