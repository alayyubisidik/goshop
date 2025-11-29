<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class UserReviewController extends Controller
{
    function index()
    {
        $reviews = ProductReview::with('product:id,name,slug')->where('user_id', user()->id)->paginate(20);
        return view('frontend.dashboard.review.index', compact('reviews'));
    }
}
