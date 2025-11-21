<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\AlertService;
use App\Services\SettingService;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        return view("admin.dashboard.setting.sections.general-settings");
    }

    public function generalSettings(Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            "site_name" => ["required", "string", "max:255"],
            "site_email" => ["nullable", "email", "max:255"],
            "site_phone" => ["nullable", "string", "max:255"],
            "site_currency" => ["required", "string", "max:255"],
            "site_currency_icon" => ["required", "string", "max:255"],
        ]);

        foreach ($validatedData as $key => $value) {
            Setting::updateOrCreate(
                ["key" => $key],
                ["value" => $value],
            );
        }

        $settings = app()->make(SettingService::class);
        $settings->clearCashedSettings();

        AlertService::updated();

        return to_route("admin.settings.index");
    }
}
