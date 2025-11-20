<?php

use App\Http\Controllers\Vendor\ProfileController;
use App\Http\Controllers\Vendor\DashboardController;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "vendor", "as" => "vendor.", "middleware" => ["auth", "verified", "role:vendor"]], function () {
    Route::get("/dashboard", [DashboardController::class, "index"])->name("dashboard.index");

    Route::get("/profile", [ProfileController::class, "index"])->name("profile.index");
    Route::put("/profile", [ProfileController::class, "update"])->name("profile.update");
    Route::put("/profile-password", [ProfileController::class, "passwordUpdate"])->name("password.update");

    Route::resource("/store-profile", StoreController::class);


    // Route::resource("/store-profile", StoreController::class);

});



require __DIR__ . '/auth.php';
