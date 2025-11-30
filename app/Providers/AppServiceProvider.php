<?php

namespace App\Providers;

use App\Http\Controllers\Admin\AdvertisementController;
use App\Models\AdvertisementBanner;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();

        Gate::before(function ($user) {
            return $user->hasRole("Super Admin") ? true : null;
        });

        View()->composer('*', function ($view) {

            $ads = AdvertisementBanner::all()->groupBy('banner_id');
            $view->with('ads', $ads);
        });
    }
}
