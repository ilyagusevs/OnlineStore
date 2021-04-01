<?php

namespace App\Http\Controllers;

use App\Models\Order;

class AdminController extends Controller
{
    public function adminOrders() {
        $orders = Order::get();
        
        return view('auth.adminpanel.orders', compact('orders'));
    }
}
