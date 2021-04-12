@extends('layouts.navbar-footer')

@section('title', 'JUST SPORT | CART')

@section('content')
<head>
    <link rel="stylesheet" href="/css/cart.css">
</head>
<div class="container">  
<!--Section: Block Content-->
@if (count($products))
    @php
        $cartCost = 0;
        $delivery = 10;
    @endphp
<section>
  <!--Grid row-->
  <div class="row">

    <!--Grid column-->
    <div class="col-lg-8">

      <!-- Card -->
      <div class="mb-3">
        <div class="pt-4 wish-list">
            @foreach($products as $product)
                @php
                    $productNewPrice = $product->new_price;
                    $productOldPrice = $product->old_price;
                    $productQuantity =  $product->pivot->quantity;
                    $productCost = $productNewPrice * $productQuantity;
                    $cartCost = $cartCost + $productCost;

                    $image = '';
                    if(count($product->images) > 0){
                        $image = $product->images[0]['img'];
                    }else{
                        $image = 'no_image.png';
                    }
                @endphp
                <form action="{{ route('cart-remove', ['id' => $product->id]) }}" method="post">
                    @csrf
                    <button style="float: right;" type="submit" class="btn-close" aria-label="Close"></button>
                </form>
            <div class="row mb-4">
                <div class="col-md-5 col-lg-3 col-xl-3">
                    <a style="text-decoration:none;" href="{{route('showProduct',[$product->category['slug'], $product->slug])}}" >
                        <img class="img-fluid w-100" src="/css/productImages/{{$image}}" alt="{{$product->slug}}">
                    </a>
                </div>
                <div class="col-md-7 col-lg-9 col-xl-9">
                    <div>
                        <div class="d-flex justify-content-between">
                        <div>
                            @if($productNewPrice != $productOldPrice)
                                <div class="price">
                                    <p class="newprice" >&euro; {{ number_format($productNewPrice, 2, '.', '') }}</p>
                                    <p class="oldprice" >&euro; {{ number_format($productOldPrice, 2, '.', '') }}</p>
                                </div>    
                            @else
                                <p style="font-weight: bold;">&euro; {{ number_format($productOldPrice, 2, '.', '') }}</p>
                            @endif
                            <a style="text-decoration:none;" href="{{route('showProduct',[$product->category['slug'], $product->slug])}}" >
                                <p class="mb-3 text-muted">{{ $product->brand->title }} {{$product->title}}</p>
                            </a>
                                
                                <p class="mb-3 text-muted">Size: {{ $product->pivot->size }}</p>
                           
                            <form action="{{ route('cart-minus', ['id' => $product->id]) }}" method="post" class="d-inline">
                                @csrf
                                <span>Qty:</span>
                                <button type="submit" class="m-0 p-0 border-0 bg-transparent">
                                    <i style="margin-left: 10px;" class="fas fa-minus-square"></i>
                                </button>
                            </form>
                            <span class="mx-1">{{ $productQuantity }}</span>
                            <form action="{{ route('cart-plus', ['id' => $product->id]) }}"
                                method="post" class="d-inline">
                                @csrf
                                <button type="submit" class="m-0 p-0 border-0 bg-transparent">
                                    <i class="fas fa-plus-square"></i>
                                </button>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
          </div>
          <hr class="my-4">
        @endforeach
        </div>
      </div>
      <!-- Card -->

    </div>
    <!--Grid column-->

    <!--Grid column-->
    <div class="col-lg-4">
        <div class="mb-3">
            <div class="pt-4">
                <h5 style="font-weight: bold;" class="mb-3">TOTAL</h5>
                <hr class="my-4">
                <ul class="list-group list-group-flush">
                    <li style="font-weight: bold;" class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                    Sub-total
                    <span style="font-weight: 100;">&euro; {{ number_format($cartCost, 2, '.', '') }}</span>
                    </li>
                    <li style="font-weight: bold;" class="list-group-item d-flex justify-content-between align-items-center px-0">
                    Delivery
                    <span style="font-weight: 100;"> 
                        @if($cartCost > 30)
                            <p style="margin-left:auto;">Free</p>
                        @else
                            <p style="margin-left:auto;">&euro; {{ number_format($delivery, 2, '.', '') }}</p>
                        @endif
                    </span>
                    </li>
                </ul>
                <hr class="my-4">
                @auth
                    <div class="text-center">
                        <a href="{{ route('cart-checkout') }}" style="font-weight: bold;" class="btn btn-success" type="submit">CHECKOUT</a>
                    </div>
                @endauth
                @guest
                    <div class="text-center">
                        <a href="{{ route('login') }}" style="font-weight: bold;" class="btn btn-success" type="submit">CHECKOUT</a>
                    </div>
                @endguest
                <div class="text-center">
                    <p style="margin-top: 20px;"><strong>Free delivery</strong> on orders over &euro; 30</p>
                </div>
            </div>
        </div>
    </div>
  </div>
</section>
@else
<div class="container-fluid mt-100">
    <div class="row">
        <div class="col-md-12">
            <div class="col-sm-12 empty-cart-cls text-center"><i class="fa fa-shopping-cart fa-4x"></i>
                <br>
                <h3><strong><br>Your cart is empty!</strong></h3>
            </div>
        </div>
    </div>
</div>
@endif
</div><!-- /container -->
@endsection