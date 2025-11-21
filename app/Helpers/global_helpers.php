<?php

use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


if (!function_exists('user')) {
    function user(string $guard = 'web'): User | null | Admin
    {
        return Auth::user($guard);
    }
}


if (!function_exists('setActive')) {
    function setActive(array $routes, $activeClass = 'active'): string
    {
        return request()->routeIs($routes) ? $activeClass : '';
    }
}

if (!function_exists("hasPermission")) {
    function hasPermission(array $permission): bool
    {
        /** @var \App\Models\Admin $admin */
        $admin = auth('admin')->user();

        if ($admin->hasRole("Super Admin")) return true;

        return $admin && $admin->hasAnyPermission($permission);
    }
}
