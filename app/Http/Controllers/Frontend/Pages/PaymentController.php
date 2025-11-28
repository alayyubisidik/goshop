<?php

namespace App\Http\Controllers\Frontend\Pages;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\ShippingRule;
use App\Services\AlertService;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;

class PaymentController extends Controller
{
    function index()
    {
        if (!Session::has('billing_info')) {
            AlertService::error('Please fill in your billing information before proceeding to payment.');
            return redirect()->route("products.index");
        }

        $cartItems = Cart::with('product.store')
            ->where('user_id', user()->id)
            ->get()
            ->groupBy(function ($cartItem) {
                return $cartItem->product->store_id;
            });

        $groupedCartItems = $cartItems->map(function ($items, $storeId) {
            $store = $items->first()->product->store;

            return [
                'store' => $store,
                'items' => $items
            ];
        });

        $shippingCharge = ShippingRule::find(Session::get('billing_info.shipping_method_id'))->charge;
        return view('frontend.pages.payment', compact('groupedCartItems', 'shippingCharge'));
    }

    function setPaypalConfig(): array
    {
        return [
            'mode'            => config('settings.paypal_mode'),
            'sandbox'         => [
                'client_id'      => config('settings.paypal_client_id'),
                'client_secret'  => config('settings.paypal_secret_key'),
                'app_id'         => 'APP-80W284485P519543T',
            ],
            'live'            => [
                'client_id'      => config('settings.paypal_client_id'),
                'client_secret'  => config('settings.paypal_secret_key'),
                'app_id'         => '',
            ],

            'payment_action'  => 'Sale',
            'currency'        => config('settings.paypal_currency'),
            'notify_url'      => '',
            'locale'          => 'en_US',
            'validate_ssl'    => true
        ];
    }

    function paypalPayment()
    {
        $payableAmount = getPayableAmount();

        $config = $this->setPaypalConfig();
        $provider = new PayPalClient($config);
        $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('paypal.success'),
                "cancel_url" => route('paypal.cancel'),
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => $config['currency'],
                        "value" => $payableAmount,
                    ],
                ],
            ],
        ]);

        if (isset($response['id']) && $response['status'] == 'CREATED') {
            foreach ($response['links'] as $link) {
                if ($link['rel'] == 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        }
    }

    function paymentSuccess()
    {
        return view("frontend.pages.payment-success");
    }

    function paymentCancel()
    {
        return view("frontend.pages.payment-cancel");
    }

    function paypalSuccess(Request $request)
    {
        $config = $this->setPaypalConfig();
        $provider = new PayPalClient($config);
        $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request->token);

        if ($response['status'] == 'COMPLETED') {
            $order = $response['purchase_units'][0]['payments']['captures'][0];

            OrderService::storeOrder(
                paymentId: $order['id'],
                paidAmount: $order['amount']['value'],
                paymentMethod: 'Paypal',
                currency: $order['amount']['currency_code'],
                paymentStatus: 'paid'
            );
            return to_route("payment.success");
        }

        return to_route("payment.cancel");
    }


    function stripePayment()
    {
        $payableAmount = getPayableAmount() * 100;

        Stripe::setApiKey(config('settings.stripe_secret_key'));

        $response = StripeSession::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => config('settings.stripe_currency'),
                        'product_data' => [
                            'name' => 'Product Purchase',
                        ],
                        'unit_amount' => $payableAmount
                    ],
                    'quantity' => 1
                ]
            ],
            'mode' => 'payment',
            'success_url' => route('stripe.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('stripe.cancel')
        ]);

        return redirect()->away($response->url);
    }

    function stripeSuccess(Request $request)
    {
        abort_if(empty($request->session_id), 404);

        Stripe::setApiKey(config('settings.stripe_secret_key'));

        $response = StripeSession::retrieve($request->session_id);

        if ($response->payment_status == 'paid') {
            OrderService::storeOrder(
                paymentId: $response->payment_intent,
                paidAmount: $response->amount_total / 100,
                paymentMethod: 'Stripe',
                currency: $response->currency,
                paymentStatus: 'paid'
            );

            return redirect()->route('payment.success');
        }

        return redirect()->route('payment.cancel');
    }
    function stripeCancel() {}
}
