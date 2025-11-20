<?php

use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\KycController;
use App\Http\Controllers\Frontend\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::group(["middleware" => ["auth", "verified"]], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get("/profile", [ProfileController::class, "index"])->name("profile.index");
    Route::put("/profile", [ProfileController::class, "update"])->name("profile.update");
    Route::put("/profile/password", [ProfileController::class, "passwordUpdate"])->name("password.update");

    Route::get("/kyc-verification", [KycController::class, "index"])->name("kyc.index");
    Route::post("/kyc-verification", [KycController::class, "store"])->name("kyc.store");

});



require __DIR__ . '/auth.php';
