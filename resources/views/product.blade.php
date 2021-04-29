@extends('layouts.navbar-footer')

@section('title', $product->title)

@section('custom_js')
    <script src="/js/product.js"></script>
@endsection


@section('content')
    <head>
        <link rel="stylesheet" href="/css/product.css">
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
                            <div class="details_content">
                                <div class="details_name" data-id="{{$product->id}}"><h2>{{ $product->brand->brand }} {{$product['title']}}</h2></div>
                                <div class="price">
                                    @if($product->new_price != $product->old_price)
                                        <div class="oldprice">&euro; {{ number_format($product->old_price, 2, '.', '') }}</div>
                                        <div class="newprice">&euro; {{ number_format($product->new_price, 2, '.', '') }}</div>
                                    @else
                                        <div class="oldprice1">&euro; {{ number_format($product->old_price, 2, '.', '') }}</div>
                                    @endif
                                </div>
                            <!-- In Stock -->
                                <div>
                                <div class="select-size">
                                    @auth
                                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" >
                                    @endauth
                                    @guest
                                        <input type="hidden" name="user_id" value="" >
                                    @endguest

                                    <select class="selectpicker" name="size" product-id="{{ $product->id }}" oninvalid="this.setCustomValidity('Please select a size')" required>
                                    <option value="" disabled selected>Select size</option>
                                        @foreach($product->sizes as $size)
                                            @if($size->stock == 0)
                                                <option value="{{$size->size}}" disabled>{{ $size['size'] }}</option>
                                            @else
                                                <option value="{{$size->size}}">{{ $size->size }}</option>
                                            @endif
                                        @endforeach    
                                    </select>
                                </div>
                                </div>
                                <div class="details_text">
                                    <p>{{$product->description}}</p>
                                </div>
                                    <button style="margin-top: 20px;" type="submit" class="btn btn-success">Add to cart</button>    
                                <div class="text-center">
                                    <p style="margin-top: 20px;"><i style="margin-right: 5px;" class="fas fa-truck"></i><strong>Free delivery</strong> on orders over &euro; 30</p>
                                </div>  
                            </div>
                    </form>
                </div>          
            </div>
        </div>
    </div>
    <div class="container">
    <hr class="my-5">
    <h4 style="margin-top: 40px; margin-bottom: 40px;">You may be interested in...</h4>
            <div class="row">
                <div class="col">
                    <div class="product_grid">
                        @foreach($other_products as $product)
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
            </div>
        </div>
    </div>

@endsection