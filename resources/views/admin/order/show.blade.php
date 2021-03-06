@extends('admin.admin', ['title' => 'Order details'])

@section('content')
    <h1 style="margin-top: 20px; margin-bottom: 20px;">Order details # {{ $order->id }}</h1>
    <table class="table table-bordered">
        <tr>
            <th>#</th>
            <th>Image</th>
            <th>Title</th>
            <th>Size</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Amount</th>
        </tr>
        @foreach($order->items as $product)
            @php
                $image = '';
                if(count($product->product->images) > 0){
                    $image = $product->product->images[0]['img'];
                }else{
                    $image = 'no_image.png';
                }
            @endphp
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    <a style="text-decoration:none;" href="{{route('show-product',[$product->product->category['slug'], $product->product->slug])}}" >
                        <img style="width: 110px;" src="/css/productImages/{{$image}}" alt="{{$product->product->slug}}">
                    </a>
                </td>
                <td>{{ $product->title }}</td>
                <td>{{$product->size}}</td>
                <td>&euro; {{ number_format($product->price, 2, '.', '') }}</td>
                <td>{{ $product->quantity }}</td>
                <td>&euro; {{ number_format($product->cost, 2, '.', '') }}</td>
            </tr>
        @endforeach
        <tr>
            <th colspan="6" style="text-align: right;">Total</th>
            <th>&euro; {{ number_format($order->amount, 2, '.', '') }}</th>
        </tr>
    </table>

    <h3 style="margin-top: 20px; margin-bottom: 20px;" >Buyer details</h3>
    <p>Name, surname: <strong>{{ $order->user->firstname }} {{ $order->user->lastname }}</strong></p>
    <p>Email: <a href="mailto:{{ $order->user->email }}">{{ $order->user->email }}</a></p>
    <p>Phone number: <strong>{{ $order->phone }}</strong></p>
    <p>Address: <strong>{{ $order->country }}, {{ $order->city }}, {{ $order->address }}, {{ $order->zipcode }}</strong></p>
@endsection