<?php

use App\Http\Controllers\Frontend\Dashboard\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\Pages\HomeController;
use App\Http\Controllers\Frontend\Pages\KycController;
use App\Http\Controllers\Frontend\Pages\ProductController;
use Illuminate\Support\Facades\Route;


Route::get("/products", [ProductController::class, 'index'])->name("products.index");
Route::get("/products/{slug}", [ProductController::class, 'show'])->name("products.show");

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::group(["middleware" => ["auth", "verified"]], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get("/cart", [CartController::class, "index"])->name('cart.index');
    Route::post("/add-to-cart", [CartController::class, "add"])->name('cart.add');
    Route::put("/update-cart", [CartController::class, "update"])->name('cart.update');
    Route::delete("/cart/{id}", [CartController::class, "destroy"])->name('cart.destroy');

    Route::get("/profile", [ProfileController::class, "index"])->name("profile.index");
    Route::put("/profile", [ProfileController::class, "update"])->name("profile.update");
    Route::put("/profile/password", [ProfileController::class, "passwordUpdate"])->name("password.update");

    Route::get("/kyc-verification", [KycController::class, "index"])->name("kyc.index");
    Route::post("/kyc-verification", [KycController::class, "store"])->name("kyc.store");
});



require __DIR__ . '/auth.php';
