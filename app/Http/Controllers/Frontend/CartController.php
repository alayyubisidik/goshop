<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Services\AlertService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use function Flasher\Notyf\Prime\notyf;

class CartController extends Controller
{
    function index()
    {

        $cartItems = Cart::with('product')->where('user_id', user()->id)->paginate(30);

        // if (Session::has('coupon')) {
        //     $coupon = Coupon::find(Session::get('coupon')['id']);
        //     $validateCoupon = $this->validateCoupon($coupon, $this->cartSubTotal());

        //     if (isset($validateCoupon['error'])) {
        //         Session::forget('coupon');
        //     }
        // }

        return view('frontend.pages.cart', compact('cartItems'));
    }

    function productModal(Product $product): String
    {
        $modal = view('components.product-quick-view-modal', compact('product'))->render();
        return $modal;
    }

    function add(Request $request)
    {

        $product = Product::findOrFail($request->product_id);
        $variantId = $request->variant_id;
        $quantity = $request->quantity;
        $showModal = $request->modal;

        if ($showModal == "true") {
            return response()->json([
                'status' => 'success',
                'modal' => $this->productModal($product),
                'show_modal' => true
            ]);
        }
        // check stock
        $this->checkStock($product, $variantId, $quantity);

        // Duplicate check
        if (Cart::where('user_id', user()->id)
            ->where('product_id', $product->id)
            ->when($variantId, fn($q) => $q->where('variant_id', $variantId))
            ->exists()
        ) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product already added to cart'
            ], 409);
        }

        $cart = new Cart();
        $cart->user_id = user()->id;
        $cart->product_id = $product->id;
        $cart->variant_id = $request->variant_id;
        $cart->quantity = $request->quantity;
        $cart->name = $product->name;
        $cart->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Product added to cart successfully',
            'cart_count' => cartCount(),
            'show_modal' => false
        ]);
    }

    function checkStock(Product $product, $variantId, $quantity)
    {
        if ($variantId) {
            $variant = $product->variants()->find($variantId);

            if (!$variant || !$variant->in_stock || ($variant->manage_stock && $variant->qty < $quantity)) {
                abort(422, 'Product variant out of stock');
            }
        } else {
            if (!$product->in_stock || ($product->manage_stock === 'yes' && $product->qty < $quantity)) {
                abort(422, 'Product out of stock');
            }
        }
    }

    function update(Request $request)
    {
        $cartItem = Cart::findOrFail($request->id);
        $product = Product::findOrFail($cartItem->product_id);
        $productPriceAndQty = $product->getVariantOrProductPriceAndStock($cartItem->variant_id);

        if (!$productPriceAndQty['in_stock']) {
            return response()->json([
                'message' => 'Product out of stock'
            ], 422);
        }

        if ($productPriceAndQty['qty'] > $request->qty || $productPriceAndQty['qty'] == 'Unlimited') {
            $cartItem->quantity = $request->qty;
            $cartItem->save();

            $cartItems = Cart::with('product')->where('user_id', user()->id)->get();
            $cartHtml = view('components.cart-item', compact('cartItems'))->render();
            return response()->json([
                'message' => 'Cart updated successfully',
                'html' => $cartHtml,
                "cart_sub_total" => $this->cartSubTotal()
            ], 200);
        }

        return response()->json([
            'message' => 'Product out of stock'
        ], 422);
    }

    function cartSubTotal(): float
    {
        $cartSubTotal = 0;
        $cartItems = Cart::with('product')->where('user_id', user()->id)->get();

        foreach ($cartItems as $cartItem) {
            $cartSubTotal += $cartItem->product->getVariantOrProductPriceAndStock($cartItem->variant_id)['price'] * $cartItem->quantity;
        }

        return $cartSubTotal;
    }

    function destroy(string $id)
    {
        $cartItem = Cart::findOrFail($id);
        $cartItem->delete();

        AlertService::deleted('Cart item deleted successfully');

        return back();
    }
}
