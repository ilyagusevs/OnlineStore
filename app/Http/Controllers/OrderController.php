<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orders() {
        
        $orders = Order::whereUserId(auth()->user()->id)->orderBy('created_at', 'desc')->paginate(5);
        return view('user.orders.orders', compact('orders'));
    }

    public function show(Order $order) {
        return view('user.orders.show', compact('order'));
    }
}
