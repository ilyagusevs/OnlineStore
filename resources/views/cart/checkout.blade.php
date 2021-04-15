<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="/css/checkout.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Lilita+One&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    </head>
    <title>JUST SPORT | CHECKOUT</title>
<body style="background-color:#F9F9F8; ">
    <div class="container">
            @php
                $cartCost = 0;
                $cartCostWithDelivery = 0;
                $delivery = 10;
            @endphp
            <a style="font-size: 32px;" class="navbar-brand" href="/">JUST SPORT</a>
            <div class="checkout">
                <div class="checkout-form">
                    <p class="checkout-text">CHECKOUT</p>
                    <p id="profile-name" class="profile-name-card"></p>
                    <form  method="POST" action="{{route('cart-saveorder')}}">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <a>Country</a>
                                <input class="form-control @error('country') is-invalid @enderror" id="country" type="text" name="country" value="{{ old('country') }}" autofocus>
                            </div>
                            <div class="col">
                                <a>City</a>
                                <input class="form-control @error('city') is-invalid @enderror"  id="city" type="text" name="city" value="{{ old('city') }}">
                            </div>
                        </div>
                        <a>Phone</a>
                        <input class="form-control @error('phone') is-invalid @enderror"  id="phone" type="text" name="phone" value="{{ old('phone') }}">
                        <div class="row">
                            <div class="col">
                                <a>Address</a>
                                <input class="form-control @error('address') is-invalid @enderror"  id="address" type="text" name="address" value="{{ old('address') }}">
                            </div>
                            <div class="col">
                                <a>Zip Code</a>
                                <input class="form-control @error('zipcode') is-invalid @enderror"  id="zipcode" type="text" name="zipcode" value="{{ old('zipcode') }}">
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-success" type="submit">PLACE ORDER</button>
                        </div>    
                    </form><!-- /form -->
                </div><!-- /card-container -->
                <div class="products">
                    <div class="container">
                    <div class="products-count">
                        <p>{{$positions}} ITEM(S)</p>
                        <p style="margin-left: auto;"><a class="back-to-cart" href="{{route('cart')}}">Edit</a></p>
                    </div>
                    <hr class="my-4">                  
                    @foreach($products as $product)
                    @if(auth()->user()->id == $product->pivot->user_id)
                        @php
                            $productPrice = $product->new_price;
                            $productQuantity =  $product->pivot->quantity;
                            $productCost = $productPrice * $productQuantity;
                            $cartCost =  $cartCost + $productCost;
                            $cartCostWithDelivery = $cartCost + $delivery;

                            $image = '';
                            if(count($product->images) > 0){
                                $image = $product->images[0]['img'];
                            }else{
                                $image = 'no_image.png';
                            }
                        @endphp
                            <div class="product">
                                <div class="product-image">
                                    <img src="/css/productImages/{{$image}}" alt="{{$product->title}}">
                                </div>
                                <div class="product-info">
                                    <div class="product-cost"> &euro; {{ number_format($productCost, 2, '.', '') }}</div>
                                    <div class="product-title">{{ $product->brand->title }} {{$product->title}}</div>
                                    <div class="size-text">Size: <p class="size">{{ $product->pivot->size }}</p></div>
                                    <div class="product-qty">Qty: <p class="qty">{{ $productQuantity }}</p></div>
                                </div>                            
                            </div>
                    @endif
                    @endforeach
                    <hr class="my-4">
                    <div class="total-price">
                        <p>Sub-total</p>
                        <p style="margin-left:auto;" >&euro; {{ number_format($cartCost, 2, '.', '') }}</p>
                    </div>
                    <div class="delivery">
                        <p>Delivery</p>
                        @if($cartCost > 30)
                            <p style="margin-left:auto;">Free</p>
                        @else
                            <p style="margin-left:auto;">&euro; {{ number_format($delivery, 2, '.', '') }}</p>
                        @endif
                    </div>
                    <div class="total-pay">
                        <p>TOTAL TO PAY</p>
                        @if($cartCost > 30)
                            <p style="margin-left:auto;">&euro; {{ number_format($cartCost, 2, '.', '') }}</p>
                        @else
                            <p style="margin-left:auto;">&euro; {{ number_format($cartCostWithDelivery, 2, '.', '') }}</p>
                        @endif
                    </div>
                    </div>
                </div>
            </div>
        </div><!-- /container -->
    </body>
</html>