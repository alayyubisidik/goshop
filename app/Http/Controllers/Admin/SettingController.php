<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\AlertService;
use App\Services\SettingService;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use FileUploadTrait;
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

    function commissionSettingsIndex()
    {
        return view("admin.dashboard.setting.sections.commission-settings");
    }

    function commissionSettingsStore(Request $request)
    {
        $validatedData = $request->validate([
            "admin_commission" => ["required", "numeric", "max:100"],
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

        return to_route("admin.settings.commission.index");
    }

    function siteSettingsIndex()
    {
        return view("admin.dashboard.setting.sections.site-settings");
    }

    function siteSettingsStore(Request $request)
    {
        $validatedData = $request->validate([
            'site_short_description' => ['nullable', 'string', 'max:255'],
            'site_address' => ['nullable', 'string', 'max:255'],
            'site_copyright' => ['required', 'string', 'max:255'],
            'site_hours' => ['nullable', 'string', 'max:255'],
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

    function logoSettingsIndex()
    {
        return view("admin.dashboard.setting.sections.logo-settings");
    }

    function logoSettingsStore(Request $request)
    {
        $request->validate([
            'site_logo' => ['nullable', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'site_favicon' => ['nullable', 'mimes:jpeg,png,jpg,gif,svg,ico', 'max:2048'],
        ]);

        $validatedData = [];

        // Ambil file lama atau null
        $oldLogo = config('settings.site_logo') ?? null;
        $oldFavicon = config('settings.site_favicon') ?? null;

        // Logo
        if ($request->hasFile('site_logo')) {
            $validatedData['site_logo'] = $this->uploadFile(
                $request->file('site_logo'),
                $oldLogo,            // bisa null atau path lama
                'site_logo'
            );
        }

        // Favicon
        if ($request->hasFile('site_favicon')) {
            $validatedData['site_favicon'] = $this->uploadFile(
                $request->file('site_favicon'),
                $oldFavicon,         // bisa null atau path lama
                'site_favicon'
            );
        }

        foreach ($validatedData as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        app()->make(SettingService::class)->clearCashedSettings();
        AlertService::updated();

        return to_route('admin.settings.logo.index');
    }
}
