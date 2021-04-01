@extends('layouts.navbar-footer')

@section('title', 'JUST SPORT')

@section('content')
<head>
    <link rel="stylesheet" href="/css/cart.css">
</head>
<div class="container">
    <h1 style="text-align: center;">Cart</h1>
    @if (count($products))
    @php
        $cartCost = 0;
    @endphp
        <form action="{{ route('cart-clear') }}" method="post" class="text-right">
            @csrf
            <button type="submit" class="btn btn-outline-danger mb-4 mt-0 pull-right">
                Clear cart
            </button>
        </form>
        <table class="table table-bordered">
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th></th>
            </tr>
            
            @foreach($products as $product)
                @php
                    $itemPrice = $product->new_price;
                    $itemQuantity =  $product->pivot->quantity;
                    $itemCost = $itemPrice * $itemQuantity;
                    $cartCost = $cartCost + $itemCost;

                    $image = '';
                    if(count($product->images) > 0){
                        $image = $product->images[0]['img'];
                    }else{
                        $image = 'no_image.png';
                    }
                @endphp
                <tr>
                    <td>
                        <a style="text-decoration:none;" href="{{route('showProduct',[$product->category['alias'], $product->title])}}" >
                            <img height="56px" src="/css/productImages/{{$image}}" alt="{{$product->title}}">
                            {{$product->brand}} {{$product->title}}
                        </a>
                    </td>
                    <td>&euro; {{ number_format($itemPrice, 2, '.', '') }}</td>
                    <td>
                    <form action="{{ route('cart-minus', ['id' => $product->id]) }}" method="post" class="d-inline">
                        @csrf
                            <button type="submit" class="m-0 p-0 border-0 bg-transparent">
                                <i class="fas fa-minus-square"></i>
                            </button>
                        </form>
                        <span class="mx-1">{{ $itemQuantity }}</span>
                        <form action="{{ route('cart-plus', ['id' => $product->id]) }}"
                            method="post" class="d-inline">
                            @csrf
                            <button type="submit" class="m-0 p-0 border-0 bg-transparent">
                                <i class="fas fa-plus-square"></i>
                            </button>
                    </form>
                    </td>
                    <td>&euro; {{ number_format($itemCost, 2, '.', '') }}</td>
                    <td>
                        <form action="{{ route('cart-remove', ['id' => $product->id]) }}"
                              method="post">
                            @csrf
                            <button type="submit" class="m-0 p-0 border-0 bg-transparent">
                                <i class="fas fa-trash-alt text-danger"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            <tr>
                <th colspan="3" style="text-align: right;">Total</th>
                <th>&euro; {{ number_format($cartCost, 2, '.', '') }}</th>
                <th></th>
            </tr>
        </table>
        @auth
            <a href="{{ route('cart-checkout') }}" class="btn btn-success float-right">
                Checkout
            </a>
        @endauth
        @guest
            <a href="{{ route('login') }}" class="btn btn-success float-right">
                Checkout
            </a>
        @endguest
    @else
        <h5 style="text-align: center;">Cart is empty!</h5>
    @endif
</div>
@endsection