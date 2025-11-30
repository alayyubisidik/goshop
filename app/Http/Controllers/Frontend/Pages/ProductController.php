<?php

namespace App\Http\Controllers\Frontend\Pages;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\Tag;
use App\Services\AlertService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    function index(Request $request)
    {
        $productQuery = Product::query();

        $productQuery->with([
            'images' => function ($query) {
                $query->limit(2);
            },
            'store:id,name',
            'primaryVariant'
        ]);

        $productQuery->withAvg('reviews', 'rating');

        $productQuery->when($request->filled('category'), function ($query) use ($request) {
            $category = Category::where('slug', $request->category)->first();
            // dd($category->allChildrenIds());
            if ($category) {
                $categoryIds = [$category->id];
                $categoryIds = array_merge($categoryIds, $category->allChildrenIds());

                $query->whereHas('categories', function ($query) use ($categoryIds) {
                    $query->whereIn('categories.id', $categoryIds);
                });
            }
        });

        $productQuery->when($request->filled('from') && $request->filled('to'), function ($query) use ($request) {
            $from = $request->from;
            $to   = $request->to;

            $query->where(function ($q) use ($from, $to) {
                // Blok A: Produk dengan Varian
                $q->whereHas('variants', function ($v) use ($from, $to) {
                    $v->where(function ($v2) use ($from, $to) {
                        // Sub-blok A1: Varian dengan Harga Spesial
                        $v2->where(function ($v3) use ($from, $to) {
                            $v3->whereNotNull('special_price')
                                ->whereBetween('special_price', [$from, $to]);
                        })
                            // Sub-blok A2: Varian TANPA Harga Spesial, gunakan Harga Biasa
                            ->orWhere(function ($v3) use ($from, $to) {
                                $v3->whereNull('special_price')
                                    ->whereBetween('price', [$from, $to]);
                            });
                    });
                });
            })
                // Blok B: Produk TANPA Varian
                ->orWhere(function ($q2) use ($from, $to) {
                    $q2->whereDoesntHave('variants')
                        // Sub-blok B1: Produk tanpa varian dengan Harga Spesial
                        ->where(function ($q3) use ($from, $to) {
                            $q3->whereNotNull('special_price')
                                ->whereBetween('special_price', [$from, $to]);
                        })
                        // Sub-blok B2: Produk tanpa varian TANPA Harga Spesial, gunakan Harga Biasa
                        ->orWhere(function ($q3) use ($from, $to) {
                            $q3->whereNull('special_price')
                                ->whereBetween('price', [$from, $to]);
                        });
                });
        });

        $productQuery->when($request->filled('brands'), function ($query) use ($request) {
            $query->whereIn('brand_id', $request->brands);
        });

        $productQuery->when($request->filled('tags'), function ($query) use ($request) {
            $query->whereHas('tags', function ($query) use ($request) {
                $query->whereIn('tags.id', $request->tags);
            });
        });

        $productQuery->when($request->filled('search'), function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%');
        });

        $productQuery->where('status', 'active');
        $productQuery->where('approved_status', 'approved');
        $products = $productQuery->paginate(20);

        $allMatingProductIds = (clone $productQuery)->pluck('id');

        $brands = Brand::whereHas('products', function ($query) use ($allMatingProductIds) {
            $query->whereIn('products.id', $allMatingProductIds);
        })
            ->withCount('products')
            ->take(15)
            ->get();

        $tags = Tag::whereHas('products', function ($query) use ($allMatingProductIds) {
            $query->whereIn('products.id', $allMatingProductIds);
        })
            ->withCount('products')
            ->take(15)
            ->get();

        $categories = Category::getNested();
        return view('frontend.pages.product', compact('products', 'categories', 'brands', 'tags'));
    }

    function show(string $slug)
    {
        $product = Product::with(['images:id,path,product_id'])->where('slug', $slug)->firstOrFail();

        $relatedProducts = Product::whereHas('categories', function ($query) use ($product) {
            $query->whereIn('categories.id', $product->categories->pluck('id')->toArray());
        })
            ->where('id', '!=', $product->id)
            ->where(['status' => 'active', 'approved_status' => 'approved'])
            ->distinct()
            ->take(6)
            ->get();

        $reviews = ProductReview::where("product_id", $product->id)->paginate(10);
        $reviewGroup = ProductReview::select('rating', DB::raw('count(*) as count'))
            ->where('product_id', $product->id)
            ->groupBy('rating')
            ->pluck('count', 'rating');
        $totalReviews = $reviewGroup->sum();

        $avgRating = ProductReview::where('product_id', $product->id)->avg('rating');

        return view('frontend.pages.product-show', compact('product', 'relatedProducts', 'reviews', 'reviewGroup', 'totalReviews', 'avgRating'));
    }

    function storeReview(Request $request, Product $product)
    {

        $request->validate([
            'rating' => ['required', 'numeric', 'min:1', 'max:5'],
            'review' => ['required', 'string', 'max:500'],
        ]);

        $productPurchasedByUser = Order::where('user_id', user()->id)
            ->whereHas('orderProducts', function ($query) use ($product) {
                $query->where('product_id', $product->id);
            })->exists();

        if (!$productPurchasedByUser) {
            throw ValidationException::withMessages([
                'review' => 'You have not purchased this product'
            ]);
        }

        if (ProductReview::where('product_id', $product->id)->where('user_id', user()->id)->exists()) {
            throw ValidationException::withMessages([
                'review' => 'You have already reviewed this product'
            ]);
        }

        $review = new ProductReview();
        $review->product_id = $product->id;
        $review->user_id = user()->id;
        $review->rating = $request->rating;
        $review->review = $request->review;
        $review->save();

        AlertService::created('Product Review Added Successfully');

        return response()->json(['status' => 'success', 'message' => 'Product Review Added Successfully']);
    }
}
