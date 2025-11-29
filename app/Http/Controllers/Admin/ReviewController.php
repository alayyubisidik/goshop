<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductReview;
use App\Services\AlertService;
use Illuminate\Http\Request;
use Stripe\Review;

class ReviewController extends Controller
{
    function index()
    {
        $reviews = ProductReview::paginate(30);
        return view("admin.dashboard.review.index", compact('reviews'));
    }

    function destroy(ProductReview $review)
    {
        $review->delete();
        AlertService::deleted();

        return back();
    }
}
