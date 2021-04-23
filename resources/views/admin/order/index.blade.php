@extends('admin.admin', ['title' => 'All orders'])

@section('content')
    <h1 style="margin-top: 20px; margin-bottom:20px;">All Orders</h1>

    <table class="table table-bordered">
        <tr>
            <th>#</th>
            <th width="18%">Date and time</th>
            <th width="18%">Buyer</th>
            <th width="18%">Email</th>
            <th width="18%">Phone number</th>
            <th><i class="fas fa-eye"></i></th>
        </tr>
        @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                <td>{{ $order->user->firstname }} {{ $order->user->lastname }}</td>
                <td><a href="mailto:{{ $order->email }}">{{ $order->user->email }}</a></td>
                <td>{{ $order->phone }}</td>
                <td>
                    <a href="{{ route('admin.order.show', ['order' => $order->id]) }}">
                        <button class="btn btn-success" type="button">Open</button>
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
    {{ $orders->links('pagination.pagination') }}
@endsection