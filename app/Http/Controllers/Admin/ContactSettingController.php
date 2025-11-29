<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactSetting;
use App\Services\AlertService;
use Illuminate\Http\Request;

class ContactSettingController extends Controller
{
    function index()
    {
        $section = ContactSetting::first();
        return view('admin.dashboard.contact-setting.index', compact('section'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'map_url' => 'required|url', // Pastikan ini adalah URL yang valid

            'box_title_one' => 'nullable|string|max:100', // Sesuaikan batas panjang
            'description_one' => 'nullable|string',

            'box_title_two' => 'nullable|string|max:100',
            'description_two' => 'nullable|string',

            'box_title_three' => 'nullable|string|max:100',
            'description_three' => 'nullable|string',
        ]);

        ContactSetting::updateOrCreate(
            ['id' => 1], // Assuming there's only one settings record
            $data
        );

        AlertService::updated();
        return back();
    }
}
