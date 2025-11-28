<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class UserOrderController extends Controller
{
    function index() {
        $orders = Order::where("user_id", user()->id)->latest()->paginate(30);
        return view("frontend.dashboard.order.index", compact("orders"));
    }

    function show(Order $order) {
        return view("frontend.dashboard.order.show", compact("order"));
    }
}
