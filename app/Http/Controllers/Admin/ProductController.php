<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Brand;
use App\Models\Store;
use App\Models\Category;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductStoreRequest;
use App\Http\Requests\Admin\ProductUpdateRequest;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Services\AlertService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    use FileUploadTrait;

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
        $attributeWithValues = $product?->attributeWithValues ?? [];
        $variants = $product?->variants ?? [];

        return view("admin.dashboard.product.edit", compact("stores", "brands", "tags", "categories", "product", "productCategoryIds", "productTagIds", "attributeWithValues", "variants"));
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
        $product->approved_status = $request->approved_status;
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

    function uploadImages(Request $request, ?Product $product)
    {
        // dd($request->all());
        $request->validate([
            'image' => ['required', 'image', 'max:3048']
        ]);

        $filePath = $this->uploadFile($request->file('image'), null, "product-image");

        $productImage = new ProductImage();
        $productImage->product_id = $product->id;
        $productImage->path = $filePath;
        $productImage->order = ProductImage::where('product_id', $product->id)->max('order') + 1;
        $productImage->save();

        return response()->json([
            'status'  => 'success',
            'id'    => $productImage->id,
            'path'    => asset($filePath),
            'message' => 'Image uploaded successfully'
        ]);
    }

    function destroyImage(int $id)
    {
        $image = ProductImage::findOrFail($id);

        $this->deleteFile($image->path);

        $image->delete();

        return response()->json(['status' => 'success', 'message' => 'Image deleted successfully']);
    }

    function imagesReorder(Request $request)
    {
        foreach ($request->images as $image) {
            ProductImage::where('id', $image['id'])->update(['order' => $image['order']]);
        }
    }

    function storeAttributes(Request $request, Product $product)
    {
        $request->validate([
            'attribute_name'  => ['required', 'string', 'max:255'],
            'attribute_type'  => ['required', 'string', 'in:text,color'],
        ]);

        DB::beginTransaction();
        try {
            if ($request->filled('attribute_id')) {
                $this->updateExistingAttribute($request, $product);
            } else {
                $this->createNewAttribute($request, $product);
            }

            DB::commit();

            $this->regenerateProductVariants($product);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => $th->getMessage()], 500);
        }

        return response()->json([
            'message' => 'Attribute generated successfully',
        ]);
    }

    function createNewAttribute(Request $request, Product $product)
    {
        $attribute = new Attribute();
        $attribute->name = $request->attribute_name;
        $attribute->type = $request->attribute_type;
        $attribute->save();

        $this->addAttributesValue($attribute, $request, $product);
    }

    function updateExistingAttribute(Request $request, Product $product)
    {
        $attribute = Attribute::findOrFail($request->attribute_id);
        $attribute->name = $request->attribute_name;
        $attribute->type = $request->attribute_type;
        $attribute->save();

        // remove existing relations and values for this attribute
        $this->clearAttributeData($attribute, $product);

        // add new attributes values
        $this->addAttributesValue($attribute, $request, $product);
    }

    function clearAttributeData(Attribute $attribute, Product $product)
    {
        DB::table('product_attribute_values')
            ->where('product_id', $product->id)
            ->where('attribute_id', $attribute->id)
            ->delete();

        AttributeValue::where('attribute_id', $attribute->id)->delete();
    }

    function addAttributesValue(Attribute $attribute, Request $request, Product $product)
    {
        $labels = $request->label ?? [];

        foreach ($labels as $index => $label) {
            if (empty($label)) continue;

            $attributeValue = new AttributeValue();
            $attributeValue->attribute_id = $attribute->id;
            $attributeValue->value = $label;
            $attributeValue->color = $request->color_value[$index] ?? null;
            $attributeValue->save();

            // Link to product
            DB::table('product_attribute_values')->insert([
                'product_id' => $product->id,
                'attribute_id' => $attribute->id,
                'attribute_value_id' => $attributeValue->id
            ]);
        }
    }

    function destroyAttributes(int $productId, int $attributeId)
    {
        try {
            $product = Product::findOrFail($productId);
            $attribute = Attribute::findOrFail($attributeId);

            $this->clearAttributeData($attribute, $product);
            $this->regenerateProductVariants($product);

            $product->refresh();

            $attributes = $product->attributeWithValues;

            $attribute->delete();

            $html = '';
            $variantHtml = '';

            foreach ($attributes as $attribute) {
                $html .= view('admin.product.partials.attribute', compact('attribute', 'product'))->render();
            }

            foreach ($product->variants as $variant) {
                $variantHtml .= view('admin.product.partials.variant', compact('variant'))->render();
            }

            return response()->json([
                'message' => 'Attribute deleted successfully',

            ]);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    function getAttributeGroups(Product $product)
    {
        $groupedAttributes = DB::table('product_attribute_values')
            ->where('product_id', $product->id)
            ->get()
            ->groupBy('attribute_id');

        $attributeGroups = collect();

        foreach ($groupedAttributes as $attributeId => $items) {
            $attributeValues = AttributeValue::whereIn('id', $items->pluck('attribute_value_id'))->get();
            $attributeGroups->push($attributeValues);
        }

        return $attributeGroups;
    }

    function clearExistingVariants(Product $product)
    {
        foreach ($product->variants as $variant) {
            DB::table('product_variant_attribute_value')
                ->where('product_variant_id', $variant->id)
                ->delete();
            $variant->delete();
        }
    }

    function regenerateProductVariants(Product $product)
    {
        // clear existing variants
        $this->clearExistingVariants($product);

        // get current attribute values group by attributes
        $attributeGroups = $this->getAttributeGroups($product);

        if ($attributeGroups->isEmpty()) {
            return;
        }

        $combinations = $this->cartesianProduct($attributeGroups);

        $this->createVariantsFromCombinations($product, $combinations);
    }


    function cartesianProduct(Collection $attributeGroups)
    {
        $result = [[]];

        foreach ($attributeGroups as $attributeValues) {
            $temp = [];

            foreach ($result as $resultItem) {
                foreach ($attributeValues as $attributeValue) {
                    $temp[] = array_merge($resultItem, [$attributeValue]);
                }
            }

            $result = $temp;
        }

        return $result;
    }

    function createVariantsFromCombinations(Product $product, array $combinations)
    {
        foreach ($combinations as $combination) {
            $variant = $this->createSingleVariant($product, $combination);
            $this->attachAttributesToVariant($variant, $combination);
        }
    }


    function createSingleVariant(Product $product, array $combination)
    {
        $variantName = collect($combination)->pluck('value')->implode('/');

        return ProductVariant::create([
            'product_id' => $product->id,
            'name' => $variantName,
            'price' => 0,
            'sku' => '',
            'qty' => 0,
            'is_active' => 1
        ]);
    }

    function attachAttributesToVariant(ProductVariant $variant, array $combination)
    {
        foreach ($combination as $attributeValue) {
            DB::table('product_variant_attribute_value')->insert([
                'product_variant_id' => $variant->id,
                'attribute_id' => $attributeValue->attribute_id,
                'attribute_value_id' => $attributeValue->id,
            ]);
        }
    }

    function updateVariants(Request $request, int $product)
    {
        $request->validate([
            'variant_sku' => ['nullable', 'string', 'max:255'],
            'variant_price' => ['required', 'numeric'],
            'variant_special_price' => ['nullable', 'numeric'],
            'variant_manage_stock' => ['nullable'],
            'variant_quantity' => ['nullable', 'numeric'],
            'variant_stock_status' => ['required', 'in:in_stock,out_of_stock'],
            'variant_is_default' => ['nullable'],
            'variant_is_active' => ['nullable'],
        ]);

        $product = Product::findOrFail($product);

        $variant = ProductVariant::findOrFail($request->variant_id);
        $variant->sku = $request->variant_sku;
        $variant->price = $request->variant_price;
        $variant->special_price = $request->variant_special_price;

        // Ternary operator to convert checkbox value (on/off) to 1 or 0
        $variant->manage_stock = $request->variant_manage_stock ? 1 : 0;

        $variant->qty = $request->variant_quantity;

        // Ternary operator to convert stock status string to 1 or 0 for 'in_stock'
        $variant->in_stock = $request->variant_stock_status == 'in_stock' ? 1 : 0;

        $variant->is_default = $request->variant_is_default;
        $variant->is_active = $request->variant_is_active;
        $variant->save();

        return response()->json(['message' => 'Variant updated successfully']);
    }

    function destroy(Product $product)
    {
        $user = user();

        if ($user->hasRole('Super Admin')) {
            $product->delete();
            notyf()->success('Product deleted successfully');
            return response()->json(['status' => 'success']);
        }

        notyf()->error('You do not have permission to delete this product');
        return response()->json(['status' => 'error', 'message' => 'You do not have permission to delete this product']);
    }
}
