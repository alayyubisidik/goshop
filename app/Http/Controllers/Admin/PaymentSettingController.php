<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Services\AlertService;
use App\Services\SettingService;
use App\Http\Controllers\Controller;

class PaymentSettingController extends Controller
{
    function index()
    {
        return view("admin.dashboard.payment-setting.sections.paypal-setting");
    }

    function paypalSettings(Request $request)
    {
        $validatedData = $request->validate([
            'paypal_status' => ['required', 'string', 'max:255'],
            'paypal_mode' => ['required', 'string', 'max:255'],
            'paypal_currency' => ['required', 'string', 'max:255'],
            'paypal_rate' => ['required', 'string', 'max:255'],
            'paypal_client_id' => ['required', 'string', 'max:255'],
            'paypal_secret_key' => ['required', 'string', 'max:255'],
        ]);

        foreach ($validatedData as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        $settings = app()->make(SettingService::class);
        $settings->clearCashedSettings();

        AlertService::updated();

        return redirect()->back();
    }

    function stripe()
    {
        return view("admin.dashboard.payment-setting.sections.stripe-setting");
    }

    function stripeSettings(Request $request)
    {
        $validatedData = $request->validate([
            'stripe_status' => ['required', 'string', 'max:255'],
            'stripe_mode' => ['required', 'string', 'max:255'],
            'stripe_currency' => ['required', 'string', 'max:255'],
            'stripe_rate' => ['required', 'numeric'],
            'stripe_client_id' => ['required', 'string', 'max:255'],
            'stripe_secret_key' => ['required', 'string', 'max:255'],
        ]);

        foreach ($validatedData as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        $settings = app()->make(SettingService::class);
        $settings->clearCashedSettings();

        AlertService::updated();

        return redirect()->back();
    }


}

