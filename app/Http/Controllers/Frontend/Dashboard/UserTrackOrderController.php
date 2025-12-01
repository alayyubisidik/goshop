<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\AlertService;
use Illuminate\Http\Request;

class UserTrackOrderController extends Controller
{
    function index(Request $request)
    {
        $orderId = $request->input('order-id');
        $order = null;

        if (!empty($orderId)) {
            $order = Order::where('id', $orderId)->first();
        }

        if ($order && $order->user_id !== user()->id) {
            AlertService::error('You are not authorized to view this order');
            return to_route('track-order.index');
        }

        return view('frontend.dashboard.track-order.index', compact('order'));
    }
}
