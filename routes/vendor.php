<?php

use App\Http\Controllers\Vendor\ProductController;
use App\Http\Controllers\Vendor\ProfileController;
use App\Http\Controllers\Vendor\DashboardController;
use App\Http\Controllers\Vendor\OrderController;
use App\Http\Controllers\Vendor\StoreController;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "vendor", "as" => "vendor.", "middleware" => ["auth", "verified", "user_role:vendor"]], function () {
    Route::get("/dashboard", [DashboardController::class, "index"])->name("dashboard.index");

    Route::get("/profile", [ProfileController::class, "index"])->name("profile.index");
    Route::put("/profile", [ProfileController::class, "update"])->name("profile.update");
    Route::put("/profile-password", [ProfileController::class, "passwordUpdate"])->name("password.update");

    Route::resource("/store-profile", StoreController::class);

    Route::get("/products", [ProductController::class, "index"])->name("products.index");
    Route::get("/products/{type}/create", [ProductController::class, "create"])->name("products.create");
    Route::post("/products/{type}/store", [ProductController::class, "store"])->name("products.store");
    Route::get("/products/physical/{product}/edit", [ProductController::class, "edit"])->name("products.edit");
    Route::post("/products/physical/{product}/update", [ProductController::class, "update"])->name("products.update");
    Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    Route::get("/products/digital/{product}/edit", [ProductController::class, "editDigitalProduct"])->name("products.digital.edit");
    Route::post("/products/digital/file-upload", [ProductController::class, "uploadDigitalProductFile"])->name("products.digital.file.upload");
    Route::delete('products/digital/{product}/{file}', [ProductController::class, 'destroyDigitalProductFile'])->name('products.digital.file.destroy');

    Route::post("/products/images/upload/{product?}", [ProductController::class, "uploadImages"])->name("products.images.upload");
    Route::delete("/products/images/{image}", [ProductController::class, "destroyImage"])->name("products.images.destroy");
    Route::post("/products/images/reorder", [ProductController::class, "imagesReorder"])->name("products.images.reorder");

    Route::post("/products/attributes/{product}/store", [ProductController::class, "storeAttributes"])->name("products.attributes.store");
    Route::delete("/products/attributes/{product}/{attribute}", [ProductController::class, "destroyAttributes"])->name("products.attributes.destroy");

    Route::post("/products/variants/{product}/update", [ProductController::class, "updateVariants"])->name("products.variants.update");

    Route::get("/orders", [OrderController::class, "index"])->name("orders.index");
    Route::get("/orders/{order}", [OrderController::class, "show"])->name("orders.show");
    Route::post("/orders/{order}/update", [OrderController::class, "update"])->name("orders.update");


    // Route::resource("/store-profile", StoreController::class);

});



require __DIR__ . '/auth.php';
