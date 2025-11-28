<?php

namespace App\Http\Controllers\Admin;

use App\Models\HeroBanner;
use Illuminate\Http\Request;
use App\Services\AlertService;
use App\Http\Controllers\Controller;

class HeroBannerController extends Controller
{
    public function index()
    {
        // Ambil data hero banner pertama (karena biasanya hanya 1 set)
        $heroBanner = HeroBanner::first();

        return view("admin.dashboard.section.banner.index", compact("heroBanner"));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'banner_one' => ['nullable', 'image', 'max:2048'],
            'title_one' => ['required', 'string', 'max:255'],
            'btn_url_one' => ['nullable', 'string', 'max:255'],
            'banner_two' => ['nullable', 'image', 'max:2048'],
            'title_two' => ['required', 'string', 'max:255'],
            'btn_url_two' => ['nullable', 'string', 'max:255'],
        ]);

        // Ambil data lama (jika ada)
        $heroBanner = HeroBanner::first();

        // Upload file jika ada
        if ($request->hasFile('banner_one')) {
            $validated['banner_one'] = $request->file('banner_one')->store('hero-banners', 'public');
        } else {
            $validated['banner_one'] = $heroBanner->banner_one ?? null;
        }

        if ($request->hasFile('banner_two')) {
            $validated['banner_two'] = $request->file('banner_two')->store('hero-banners', 'public');
        } else {
            $validated['banner_two'] = $heroBanner->banner_two ?? null;
        }

        // Update atau buat baru
        HeroBanner::updateOrCreate(
            ['id' => $heroBanner->id ?? 1], // kalau ada data, update id tsb; kalau belum ada, id = 1
            $validated
        );

        AlertService::created(); // tetap pakai notifikasi yang sama

        return to_route('admin.hero-banners.index');
    }
}
