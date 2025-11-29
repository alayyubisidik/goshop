<?php

namespace App\Http\Controllers\Frontend\Pages;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use App\Services\AlertService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wishlistItems = Wishlist::with('product')->where('user_id', user()->id)->paginate(20);

        return view('frontend.pages.wishlist', compact('wishlistItems'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
        ]);

        if (Wishlist::where('user_id', user()->id)->where('product_id', $request->product_id)->exists()) {
            throw ValidationException::withMessages(['error' => 'Product already in your wishlist']);
        }

        $wishlist = new Wishlist();
        $wishlist->user_id = user()->id;
        $wishlist->product_id = $request->product_id;
        $wishlist->save();

        return response()->json(['status' => 'success', 'message' => 'Product added to your wishlist']);
    }

    public function destroy(Wishlist $wishlist)
    {
        if ($wishlist->user_id != user()->id) {
            abort(403);
        }

        $wishlist->delete();

        AlertService::deleted();

        return back();
    }
}
