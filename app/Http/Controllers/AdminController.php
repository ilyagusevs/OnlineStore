<?php

namespace App\Http\Controllers;

use App\Models\Order;

class AdminController extends Controller
{
    public function adminOrders() {
        $orders = Order::get();
        
        return view('admin.orders.admin-orders', compact('orders'));
    }
}
