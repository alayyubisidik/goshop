<?php


namespace App\Services;


use App\Models\Address;
use App\Models\AdminCommission;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\StoreWallet;
use Illuminate\Support\Facades\Session;

class OrderService
{
    static function storeOrder(string $paymentId, float $paidAmount, string $paymentMethod, string $currency, string $paymentStatus)
    {
        $cartItems = Cart::with('product.store')
            ->where('user_id', user()->id)
            ->get()
            ->groupBy(function ($cartItem) {
                return $cartItem->product->store_id;
            });

        $groupProductByStore = $cartItems->map(function ($items, $storeId) {
            $store = $items->first()->product->store;

            return [
                'store' => $store,
                'items' => $items
            ];
        });

        $shippingInfoId = Session::get('billing_info')['shipping_address_id'] ?? null;
        $billingInfoId  = Session::get('billing_info')['billing_address_id'] ?? null;

        $billingInfo = Address::find($billingInfoId);
        $shippingInfo = $shippingInfoId ? Address::find($shippingInfoId) : null;

        foreach ($groupProductByStore as $store) {
            /** Store Order */
            $order = new Order();
            $order->user_id = user()->id;
            $order->transaction_id = $paymentId;
            $order->store_id = $store['store']->id;
            $order->customer_email = user()->email;

            // Billing info (WAJIB ADA)
            $order->billing_info = [
                'first_name'  => $billingInfo->first_name,
                'last_name'   => $billingInfo->last_name,
                'phone'       => $billingInfo->phone,
                'email'       => $billingInfo->email,
                'address'     => $billingInfo->address,
                'city'        => $billingInfo->city,
                'state'       => $billingInfo->state,
                'country'     => $billingInfo->country,
                'zip'         => $billingInfo->zip,
            ];

            // Shipping info (BOLEH KOSONG)
            $order->shipping_info = $shippingInfo ? [
                'first_name'  => $shippingInfo->first_name,
                'last_name'   => $shippingInfo->last_name,
                'phone'       => $shippingInfo->phone,
                'email'       => $shippingInfo->email,
                'address'     => $shippingInfo->address,
                'city'        => $shippingInfo->city,
                'state'       => $shippingInfo->state,
                'country'     => $shippingInfo->country,
                'zip'         => $shippingInfo->zip,
            ] : [];


            if (Session::has('coupon')) {
                $order->has_coupon = true;
                $order->coupon = Session::get('coupon')['code'];
                $order->discount = Session::get('coupon')['coupon_value'];
            }

            $order->shipping_charge = getShippingCharge();
            $order->total = $paidAmount;
            $order->payment_method = $paymentMethod;
            $order->currency = $currency;
            $order->currency_rate = 1;
            $order->order_status = 'pending';
            $order->payment_status = $paymentStatus;
            $order->save();

            // store admin commission
            $adminCommission = new AdminCommission();
            $adminCommission->order_id = $order->id;
            $adminCommission->commission_rate = config('settings.admin_commission');
            $adminCommission->commission_amount = round($order->total * ($adminCommission->commission_rate / 100), 2);
            $adminCommission->save();

            if (StoreWallet::where('store_id', $store['store']->id)->exists()) {
                $storeWallet = StoreWallet::where('store_id', $store['store']->id)->first();
            } else {
                $storeWallet = new StoreWallet();
            }

            $storeWallet->store_id = $store['store']->id;
            $storeWallet->balance = $storeWallet->balance + ($order->total - $adminCommission->commission_amount);
            $storeWallet->save();

            foreach ($store['items'] as $item) {
                $orderProduct = new OrderProduct();
                $orderProduct->order_id = $order->id;
                $orderProduct->product_id = $item->product_id;
                $orderProduct->product_name = $item->name;

                if ($item->variant) {
                    $orderProduct->unit_price = $item?->variant?->special_price > 0 ? $item->variant->special_price : $item->variant->price;
                } else {
                    $orderProduct->unit_price = $item->product->special_price > 0 ? $item->product->special_price : $item->product->price;
                }

                $orderProduct->variant = $item->variant;
                $orderProduct->quantity = $item->quantity;
                $orderProduct->save();
            }
        }

        self::clearCart();
    }

    private static function clearCart()
    {
        Cart::where("user_id", user()->id)->delete();
        Session::forget("billing_info");
        Session::forget("coupon");
    }
}
