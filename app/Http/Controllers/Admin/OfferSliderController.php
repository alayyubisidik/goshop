<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OfferSlider;
use App\Services\AlertService;
use Illuminate\Http\Request;

class OfferSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = OfferSlider::paginate(20);
        return view('admin.dashboard.section.offer-slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dashboard.section.offer-slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'url' => ['nullable', 'url'],
            'is_active' => ['nullable', 'boolean'],
        ]);
        $validatedData['is_active'] = $request->has('is_active') ? 1 : 0;
        OfferSlider::create($validatedData);

        AlertService::created();
        return to_route('admin.offer-sliders.index');
    }

    public function edit(OfferSlider $offer_slider)
    {
        return view('admin.dashboard.section.offer-slider.edit', compact('offer_slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OfferSlider $offer_slider)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'url' => ['nullable', 'url'],
            'is_active' => ['nullable', 'boolean'],
        ]);
        $validatedData['is_active'] = $request->has('is_active') ?? 0;
        $offer_slider->update($validatedData);

        AlertService::updated();
        return to_route('admin.offer-sliders.index');
    }

    public function destroy(OfferSlider $offer_slider)
    {
        $offer_slider->delete();
        AlertService::deleted();
        return response()->json(["status" => "success", "message" => "Offer slider deleted successfully"]);
    }
}
