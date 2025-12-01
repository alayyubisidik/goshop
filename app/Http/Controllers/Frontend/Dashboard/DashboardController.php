<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Order;
use App\Models\ProductReview;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function index()
    {
        $totalOrders = Order::where('user_id', user()->id)->count();
        $totalCanceledOrders = Order::where('user_id', user()->id)->where('order_status', 'canceled')->count();
        $totalPendingOrders = Order::where('user_id', user()->id)->where('order_status', 'pending')->count();
        $totalReviews = ProductReview::where('user_id', user()->id)->count();
        $totalWishlists = Wishlist::where('user_id', user()->id)->count();
        $totalAddresses = Address::where('user_id', user()->id)->count();

        return view('frontend.dashboard.main.index', compact(
            'totalOrders',
            'totalCanceledOrders',
            'totalPendingOrders',
            'totalReviews',
            'totalAddresses',
            'totalWishlists'
        ));
    }
}
