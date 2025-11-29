<?php

namespace App\Http\Controllers\Frontend\Pages;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryYouMayLike;
use App\Models\CustomPage;
use App\Models\FlashSale;
use App\Models\HeroBanner;
use App\Models\Order;
use App\Models\PopularCategory;
use App\Models\Product;
use App\Models\ProductReview;
use App\Models\Slider;
use App\Services\AlertService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class HomeController extends Controller
{
    function index()
    {
        $featuredCategories = Category::withCount('products')
            ->where("is_featured", true)
            ->take(15)
            ->get();

        $sliders = Slider::where("is_active", true)->get();
        $heroBanner = HeroBanner::first();

        $popularCategoryIds = PopularCategory::first()->categories ?? [];
        $popularCategories = Category::whereIn('id', $popularCategoryIds)->get();
        $popularProducts = $this->productsByCategory($popularCategoryIds);

        $flashSale = FlashSale::first();
        $flashSaleProducts = Product::whereIn('id', $flashSale?->products ?? [])
            ->get();

        $categoryYouMayLike = CategoryYouMayLike::first();

        $categoryYouMayLikeIds = [
            $categoryYouMayLike?->category_one,
            $categoryYouMayLike?->category_two,
            $categoryYouMayLike?->category_three
        ];

        $categoryYouMayLikeProducts = $this->productsByCategory($categoryYouMayLikeIds);


        return view('frontend.home.index', compact(
            'featuredCategories',
            'sliders',
            'heroBanner',
            'popularCategories',
            'popularProducts',
            'flashSale',
            'flashSaleProducts',
            'categoryYouMayLikeProducts'
        ));
    }

    function productsByCategory(array $categoryIds)
    {
        $results = [];

        foreach ($categoryIds as $categoryId) {
            $category = Category::find($categoryId);
            if ($category) {
                $ids = [$category->id];
                $ids = array_merge($ids, $category->allChildrenIds());

                $products = Product::whereHas('categories', function ($query) use ($ids) {
                    $query->whereIn('categories.id', $ids);
                })
                    ->whereIsFeatured(true)
                    ->take(12)
                    ->get();

                $results[$categoryId] = $products;
            }
        }
        return $results;
    }

    function customPage(string $slug)
    {
        $page = CustomPage::where('slug', $slug)->where('is_active', true)->firstOrFail();
        return view('frontend.pages.custom-page', compact('page'));
    }
}
