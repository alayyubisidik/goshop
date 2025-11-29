<?php

use App\Http\Controllers\Frontend\Dashboard\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Frontend\Dashboard\AddressController;
use App\Http\Controllers\Frontend\Dashboard\UserOrderController;
use App\Http\Controllers\Frontend\Dashboard\UserReviewController;
use App\Http\Controllers\Frontend\Pages\CartController;
use App\Http\Controllers\Frontend\Pages\CheckoutController;
use App\Http\Controllers\Frontend\Pages\ContactController;
use App\Http\Controllers\Frontend\Pages\HomeController;
use App\Http\Controllers\Frontend\Pages\KycController;
use App\Http\Controllers\Frontend\Pages\NewsletterController;
use App\Http\Controllers\Frontend\Pages\PaymentController;
use App\Http\Controllers\Frontend\Pages\ProductController;
use App\Http\Controllers\Frontend\Pages\WishlistController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::get("/products", [ProductController::class, 'index'])->name("products.index");
Route::get("/products/{slug}", [ProductController::class, 'show'])->name("products.show");

Route::get("/contact", [ContactController::class, "index"])->name("contact.index");
Route::post("/contact", [ContactController::class, "store"])->name("contact.store");


Route::group(["middleware" => ["auth", "verified"]], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get("/kyc-verification", [KycController::class, "index"])->name("kyc.index");
    Route::post("/kyc-verification", [KycController::class, "store"])->name("kyc.store");

    Route::get("/cart", [CartController::class, "index"])->name('cart.index');
    Route::post("/add-to-cart", [CartController::class, "add"])->name('cart.add');
    Route::put("/update-cart", [CartController::class, "update"])->name('cart.update');
    Route::delete("/cart/{id}", [CartController::class, "destroy"])->name('cart.destroy');

    Route::post("/cart/coupon", [CartController::class, "applyCoupon"])->name('cart.coupon');
    Route::delete("/cart/coupon/remove", [CartController::class, "destroyCoupon"])->name('cart.coupon.destroy');

    Route::get("/profile", [ProfileController::class, "index"])->name("profile.index");
    Route::put("/profile", [ProfileController::class, "update"])->name("profile.update");
    Route::put("/profile/password", [ProfileController::class, "passwordUpdate"])->name("password.update");

    Route::resource("address", AddressController::class);

    Route::get("/checkout", [CheckoutController::class, "index"])->name("checkout.index");
    Route::get("/shipping-method/{id}", [CheckoutController::class, "shippingMethod"])->name("checkout.shipping");
    Route::post("/billing-info", [CheckoutController::class, "billingInfo"])->name("checkout.billing-info.store");

    Route::get("/payment", [PaymentController::class, "index"])->name("payment.index");
    Route::get("/payment/success", [PaymentController::class, "paymentSuccess"])->name("payment.success");
    Route::get("/payment/cancel", [PaymentController::class, "paymentCancel"])->name("payment.cancel");

    Route::get("/paypal/payment", [PaymentController::class, "paypalPayment"])->name("paypal.payment");
    Route::get("/paypal/success", [PaymentController::class, "paypalSuccess"])->name("paypal.success");
    Route::get("/paypal/cancel", [PaymentController::class, "paypalCancel"])->name("paypal.cancel");

    Route::get("/stripe/payment", [PaymentController::class, "stripePayment"])->name("stripe.payment");
    Route::get("/stripe/success", [PaymentController::class, "stripeSuccess"])->name("stripe.success");
    Route::get("/stripe/cancel", [PaymentController::class, "stripeCancel"])->name("stripe.cancel");

    Route::get("/orders", [UserOrderController::class, "index"])->name("orders.index");
    Route::get("/orders/{order}", [UserOrderController::class, "show"])->name("orders.show");

    Route::post("/products/reviews/{product}", [ProductController::class, "storeReview"])->name("products.review");
    Route::get("/reviews", [UserReviewController::class, "index"])->name("reviews.index");

    Route::resource('wishlist', WishlistController::class);

    Route::post("/newsletter", [NewsletterController::class, "store"])->name("newsletter.store");






});



require __DIR__ . '/auth.php';
