@extends('layouts.navbar-footer')

@section('title', 'JUST SPORT')

@section('custom_js')
    <script>
    (function(){
        const currentImage = document.querySelector('#currentImage');
        const images = document.querySelectorAll('.details_image_thumbnail');

        images.forEach((element) => element.addEventListener('click', thumbnailClick));

        function thumbnailClick(e) {
            currentImage.src = this.querySelector('img').src;

            images.forEach((element) => element.classList.remove('active'));

            this.classList.add('active');
        }

    })();
    </script>
@endsection

@section('content')
    <head>
        <link rel="stylesheet" href="/css/product.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous"/>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
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
                    <div class="details_content">
                        <div class="details_name" data-id="{{$item->id}}"><h2>{{$item->title}}</h2></div>
                        <div class="price">
                            @if($item->new_price != null)
                                <div class="details_discount">&euro; {{$item->price}}</div>
                                <div class="details_price">&euro; {{$item->new_price}}</div>
                            @else
                                <div class="details_price">&euro; {{$item->price}}</div>
                            @endif
                        </div>
                      

                        <!-- In Stock -->
                        <div class="in_stock_container">
                            <div class="availability">Availability:</div>
                                @if($item->in_stock)
                                    <span style="color: green">In Stock</span>
                                @else
                                    <span style="color: red">Out of stock</span>
                                @endif
                        </div>
                        <div class="details_text">
                            <p>{{$item->description}}</p>
                        </div>

                        <!-- Product Quantity -->
                        <div class="product_quantity_container">
                            <div class="product_quantity clearfix">
                                <span>Quantity</span>
                                <input style="width: 80px;" id="quantity_input" type="text" pattern="[0-9]*" value="1">
                        </div>
                        <button style="margin-top: 20px;" type="button" class="btn btn-outline-dark">Add to cart</button>  
                    </div>
                </div>
            </div>
        </div>
    </div>
   
@endsection