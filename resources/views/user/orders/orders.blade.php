@extends('layouts.navbar-footer')

@section('title', 'JUST SPORT | MY ORDERS')

@section('content')
<div class="container">
    @if($orders->count())
        <table class="table table-bordered">
        <tr>
            <th width="2%">№</th>
            <th width="19%">Date and time</th>
            <th width="19%">Buyer</th>
            <th width="24%">Email</th>
            <th width="22%">Phone number</th>
            <th width="2%"><i class="fas fa-eye"></i></th>
        </tr>
        @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                <td>{{ $order->user->firstname }} {{ $order->user->lastname }}</td>
                <td><a href="mailto:{{ $order->user->email }}">{{ $order->user->email }}</a></td>
                <td>{{ $order->phone }}</td>
                <td>
                    <a href="{{ route('user.show-order', ['order' => $order->id]) }}">
                        <i class="fas fa-eye"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        </table>
        {{ $orders->links('pagination.pagination') }}
    @else
    <div class="container-fluid mt-100">
        <div class="row">
            <div class="col-md-12">
                <div style="margin-top: 300px;" class="col-sm-12 empty-cart-cls text-center"><i class="fas fa-box fa-4x"></i>
                    <br>
                    <h3><strong><br>No orders yet!</strong></h3>
                </div>
            </div>
        </div>
        </div>
    @endif
</div>
@endsection

