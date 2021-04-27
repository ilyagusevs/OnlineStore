@extends('layouts.navbar-footer')

@section('title', 'JUST SPORT | ORDER DETAILS')

@section('content')
<head>
    <link rel="stylesheet" href="/css/show-order.css">
</head>
<div class="container">
    @php
        $delivery = 10;
    @endphp
<h1 style="margin-top: 20px; margin-bottom: 20px;">Order details #{{ $order->id }}</h1>
    <div class="products">
        @foreach($order->items as $item)
            @php
                $cartAmountWithDelivery = $order->amount + $delivery;

                $image = '';
                if(count($item->product->images) > 0){
                    $image = $item->product->images[0]['img'];
                }else{
                    $image = 'no_image.png';
                }
            @endphp
                <div class="product">
                    <div class="product_image">
                        <a href="{{route('show-product',[$item->product->category['slug'], $item->product->slug])}}"><img src="/css/productImages/{{$image}}" alt="{{$item->product->slug}}"></a>
                        <div class="product_content">
                            <div class="product_title">{{ $item->brand }} {{$item->title}}</div>
                            <div class="prices">
                                @if($item->product->new_price != $item->product->old_price)
                                    <div class="product_price" >&euro; {{ number_format($item->product->old_price, 2, '.', '') }}</div>
                                    <div class="product_new_price">&euro; {{ number_format($item->product->new_price, 2, '.', '') }}</div>
                                @else
                                    <div class="product_price1">&euro; {{ number_format($item->product->old_price, 2, '.', '') }}</div>
                                @endif    
                            </div>
                            <div class="product-size">Size: <p class="qty">{{ $item->size }}</p></div>  
                            <div class="product-qty">Qty: <p class="size">{{ $item->quantity }}</p></div>  
                        </div>    
                    </div>
                </div>
        @endforeach
    </div>
    <div class="total-address">
        <div class="total">
            <strong>ORDER TOTAL</strong>
            <hr class="my-4">  
            <div class="total-price">
                <p>Sub-total</p>
                <p style="margin-left:auto;" >&euro; {{ number_format($order->amount, 2, '.', '') }}</p>
            </div>
            <div style="margin-bottom: -20px;"  class="delivery">
                <p >Delivery</p>
                @if($item->cost > 30)
                    <p style="margin-left:auto;">Free</p>
                @else
                    <p style="margin-left:auto;">&euro; {{ number_format($delivery, 2, '.', '') }}</p>
                @endif
            </div>
            <hr class="my-4">  
            <div class="total-pay">
                <strong>TOTAL</strong>
                @if($item->cost > 30)
                    <p style="margin-left:auto;">&euro; {{ number_format($order->amount, 2, '.', '') }}</p>
                @else
                    <p style="margin-left:auto;">&euro; {{ number_format($cartAmountWithDelivery, 2, '.', '') }}</p>
                @endif
            </div>
        </div>
        <div class="address">
            <strong>DELIVERY DETAILS</strong>
            <hr class="my-4"> 
            <p>{{ $order->user->firstname }} {{ $order->user->lastname }}</p>
            <p>{{ $order->address }}</p>
            <p>{{ $order->country }}, {{ $order->city }}, {{ $order->zipcode }}</p>
            <p>{{ $order->phone }}</p>
        </div>
    </div>
</div>
@endsection