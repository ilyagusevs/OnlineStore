@extends('auth.adminpanel.admin')

@section('content')

<div class="col-md-12">
        <h1>Orders</h1>
        <table class="table">
            <tbody>
            <tr>
                <th>User</th>
                <th>Country</th>
                <th>City</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Zip Code</th>
                <th>Amount</th>
                <th>Time</th>
                <th></th>
            </tr>
            @foreach($orders as $order)
                <tr>
                    <td>{{$order->user->email}}</td>
                    <td>{{ $order->country}}</td>
                    <td>{{ $order->city }}</td>
                    <td>{{ $order->phone }}</td>
                    <td>{{ $order->address }}</td>
                    <td>{{ $order->zipcode }}</td>
                    <td>&euro; {{ $order->amount }}</td>
                    <td>{{ $order->created_at->format('H:i d/m/Y') }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <a class="btn btn-success" type="button"
                               href="#">Open</a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
