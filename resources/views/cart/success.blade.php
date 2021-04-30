@extends('layouts.navbar-footer')

@section('content')
<head>
    <link rel="stylesheet" href="/css/successOrder.css">
</head>
<title>JUST SPORT | SUCCESS</title>
<div class="container">
<h1>Order placed</h1>

<p>Your order has been successfully placed. Our manager will contact you shortly to clarify the details.</p>

<h2>Your order</h2>
    <table class="table table-bordered">
        <tr>
            <th>Product</th>
            <th>Size</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Cost</th>
            
        </tr>
      
        @foreach($order->items as $item)
            <tr>
                <td>{{ $item->title }}</td>
                <td>{{ $item->size }}</td>
                <td>&euro; {{ number_format($item->price, 2, '.', '') }}</td>
                <td>{{ $item->quantity }}</td>
                <td>&euro; {{ number_format($item->cost, 2, '.', '') }}</td>
                
            </tr>
        @endforeach
        <tr>
            <th style="text-align: right;" colspan="2" class="text-right">Total</th>
            <th>&euro; {{ number_format($order->amount, 2, '.', '') }}</th>
            <th></th>
        </tr>
    </table>

    <h2>Your data</h2>
    <p>Name, Surname: <strong>{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}</strong></p>
    <p>Email: <strong>{{ auth()->user()->email }}</strong></p>
    <p>Address: <strong>{{$order->country}}, {{$order->city}}, {{ $order->address }}, {{$order->zipcode}}</strong></p>
    <p>Phone number: <strong>{{$order->phone}}</strong></p>

</div>

@endsection