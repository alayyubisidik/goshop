<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatusHistory;
use App\Services\AlertService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class OrderController extends Controller implements HasMiddleware
{
    static function Middleware(): array
    {
        return [
            new Middleware('permission:Order Management')
        ];
    }

    function index(Request $request)
    {
        $orders = Order::where('payment_status', 'paid')
            ->when($request->filled('status'), function ($query) use ($request) {
                return $query->where('order_status', $request->status);
            })
            ->latest()
            ->paginate(30);

        return view('admin.dashboard.order.index', compact('orders'));
    }

    function show(Order $order)
    {
        return view("admin.dashboard.order.show", compact("order"));
    }

    function update(Request $request, Order $order)
    {
        $request->validate([
            'order_status' => ['required', 'in:pending,processing,packed,shipped,in_transit,out_for_delivery,delivered,canceled']
        ]);

        $order->order_status = $request->order_status;
        $order->save();

        $orderStatusHistory = new OrderStatusHistory();
        $orderStatusHistory->order_id = $order->id;
        $orderStatusHistory->status = $request->order_status;
        $orderStatusHistory->comment = config('order_status')[$request->order_status];
        $orderStatusHistory->save();

        AlertService::updated();
        return redirect()->back();
    }
}
