<?php

namespace App\Http\Controllers\Frontend\Pages;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;

class VendorPageController extends Controller
{
    function index()
    {
        $vendors = User::with(['kyc' => function ($query) {
            $query->where('status', 'approved');
        }, 'store' => function ($query) {
            $query->withAvg('reviews', 'rating');
        }])
            ->withCount('products')
            ->where('user_type', 'vendor')
            ->paginate(16);


        return view('frontend.pages.vendor', compact('vendors'));
    }

    function show(int $id)
    {
        $vendor = Store::with(['products' => function ($query) {
            $query->withAvg('reviews', 'rating');
        }])
            ->withAvg('reviews', 'rating')
            ->where('seller_id', $id)
            ->firstOrFail();

        return view('frontend.pages.vendor-detail', compact('vendor'));
    }


}
