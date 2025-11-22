<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Brand;
use App\Models\Store;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductStoreRequest;
use App\Http\Requests\Admin\ProductUpdateRequest;
use App\Models\Product;
use App\Services\AlertService;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(20);
        return view("admin.dashboard.product.index", compact("products"));
    }

    public function create()
    {
        $stores = Store::select(['id', 'name'])->get();
        $brands = Brand::select(['id', 'name'])->get();
        $tags = Tag::where("is_active", 1)->get();
        $categories = Category::getNested();
        return view("admin.dashboard.product.create", compact("stores", "brands", "tags", "categories"));
    }

    function store(ProductStoreRequest $request)
    {
        $product = new Product();

        $product->product_type = "physical";

        $product->store_id = $request->store_id;
        $product->brand_id = $request->brand_id;

        $product->name = $request->name;
        $product->slug = Str::slug($request->name);

        $product->price = $request->price;

        $product->description = $request->description;
        $product->short_description = $request->short_description;

        $product->special_price = $request->special_price;
        $product->special_price_start = $request->special_price_start;
        $product->special_price_end = $request->special_price_end;

        $product->sku = $request->sku;

        // boolean fields
        $product->manage_stock = $request->has('manage_stock') ? 1 : 0;
        $product->in_stock = $request->in_stock == 1 ? 1 : 0;

        $product->qty = $request->qty;

        // view default sudah 0 dari migration
        // $product->viewed = 0; (tidak perlu)

        $product->status = $request->status;
        $product->approved_status = "approved";

        // optional flags
        $product->is_featured = $request->has('is_featured') ? 1 : 0;
        $product->is_hot = $request->has('is_hot') ? 1 : 0;
        $product->is_new = $request->has('is_new') ? 1 : 0;

        $product->save();

        // relations
        $product->categories()->sync($request->categories);
        $product->tags()->sync($request->tags);

        return response()->json([
            "id" => $product->id,
            "redirect_url" => route("admin.products.edit", $product) . '#product-images',
            "status" => "success",
            "message" => "Product created successfully"
        ]);
    }

    function edit(int $id)
    {
        $product = Product::findOrFail($id);
        $productCategoryIds = $product->categories->pluck("id")->toArray();
        $productTagIds = $product->tags->pluck("id")->toArray();
        $stores = Store::select(['id', 'name'])->get();
        $brands = Brand::select(['id', 'name'])->get();
        $tags = Tag::where("is_active", 1)->get();
        $categories = Category::getNested();

        return view("admin.dashboard.product.edit", compact("stores", "brands", "tags", "categories", "product", "productCategoryIds", "productTagIds"));
    }

    function update(ProductUpdateRequest $request, int $id)
    {
        $product = Product::findOrFail($id);
        $slugRequest = Str::slug($request->name);
        if ($slugRequest !== $product->slug) {
            $slugExists = Product::where('slug', $slugRequest)
                ->where('id', '!=', $id)
                ->exists();

            if ($slugExists) {
                throw ValidationException::withMessages([
                    "name" => "Product name already in use"
                ]);
            }
        }

        $product->name = $request->name;
        $product->slug = $slugRequest;
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->special_price = $request->special_price;
        $product->special_price_start = $request->from_date;
        $product->special_price_end = $request->to_date;
        $product->qty = $request->qty;
        $product->manage_stock = $request->has('manage_stock') ? 1 : 0;
        $product->in_stock = $request->in_stock == 1 ? 1 : 0;
        $product->status = $request->status;
        $product->store_id = $request->store_id;
        $product->brand_id = $request->brand_id;
        $product->is_featured = $request->has('is_featured') ? 1 : 0;
        $product->is_hot = $request->has('is_hot') ? 1 : 0;
        $product->is_new = $request->has('is_new') ? 1 : 0;
        $product->save();

        $product->categories()->sync($request->categories);
        $product->tags()->sync($request->tags);

        AlertService::updated();

        return response()->json([
            "id" => $product->id,
            "status" => "success",
            "message" => "Product updated successfully",
            "redirect_url" => route('admin.products.index')
        ]);
    }
}
