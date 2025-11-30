<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdvertisementBanner;
use App\Services\AlertService;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    use FileUploadTrait;
    function bannerOne()
    {
        $banners = AdvertisementBanner::all()->groupBy('banner_id');
        return view('admin.dashboard.advertisement-banner.sections.banner-one', compact('banners'));
    }
    function bannerTwo()
    {
        $banners = AdvertisementBanner::all()->groupBy('banner_id');

        return view('admin.dashboard.advertisement-banner.sections.banner-two', compact('banners'));
    }

    function ctaBanner()
    {
        $banners = AdvertisementBanner::all()->groupBy('banner_id');

        return view('admin.dashboard.advertisement-banner.sections.cta-banner', compact('banners'));
    }

    function flashSaleBanner()
    {
        $banners = AdvertisementBanner::all()->groupBy('banner_id');

        return view('admin.dashboard.advertisement-banner.sections.flash-sale', compact('banners'));
    }

    function productSidebarBanner()
    {
        $banners = AdvertisementBanner::all()->groupBy('banner_id');

        return view('admin.dashboard.advertisement-banner.sections.product-sidebar', compact('banners'));
    }

    function store(Request $request)
    {
        $validated = $request->validate([
            'banner_id' => 'required|string|in:banner_one,banner_two,banner_three,banner_four,banner_five,banner_six,banner_seven,cta_banner,flash_sale,product_sidebar',
            'image' => 'nullable|image',
            'url' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {

            $oldPath = AdvertisementBanner::where('banner_id', $request->banner_id)->value('image');

            $validated['image'] = $this->uploadFile(
                $request->file('image'),
                $oldPath,
                'advertisement'
            );
        }

        AdvertisementBanner::updateOrCreate(
            ['banner_id' => $request->banner_id],
            $validated
        );

        AlertService::updated();

        return back();
    }
}
