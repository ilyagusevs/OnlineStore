@extends('layouts.navbar-footer')

@section('title', 'JUST SPORT | MY ORDERS')

@section('content')
<head>
    <link rel="stylesheet" href="/css/orders.css">
</head>
<div class="container">
    @if($orders->count())
        <div class="products">
            <table class="table borderless">
            @foreach($orders as $order)
                <tr>
                    <td>
                        <div style="margin-top:20px;" class="row">
                            <div class="col">
                                <strong>Order #{{$order->id}}</strong>
                                <br>
                            </div>
                            <div class="col">
                                <strong>Order date:</strong>
                                <br>
                                <strong>{{ $order->created_at->format('F j, Y') }}</strong>
                                <br>
                            </div>
                        </div>
                        @foreach($order->items as $item)
                            @php
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
                                </div>
                            </div>
                        @endforeach
                        <td>
                            <a href="{{ route('user.show-order', ['order' => $order->id]) }}">
                                <button style="margin-top:20px;" class="btn btn-outline-secondary"><strong>View order</strong></button>
                            </a>
                        </td>
                    </td>  
                </tr>
            @endforeach
            </table>
        </div>
        {{ $orders->links('pagination.pagination') }}
    @else
        <div class="row">
            <div class="col-md-12">
                <div style="margin-top: 300px;" class="col-sm-12 empty-cart-cls text-center"><i class="fas fa-box fa-4x"></i>
                    <br>
                    <h3><strong><br>No orders yet!</strong></h3>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

