<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Services\AlertService;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::paginate(20);
        return view("admin.dashboard.section.slider.index", compact("sliders"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.dashboard.section.slider.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'image' => ['required', 'image', 'max:2048'],
            'title' => ['required', 'string', 'max:255'],
            'sub_title' => ['required', 'string', 'max:255'],
            'btn_url' => ['nullable', 'string', 'max:255'],
            'is_active' => ['boolean', 'nullable'],
        ]);

        $logoPath = $this->uploadFile($validated['image'], null, "slider");
        $validated["image"] = $logoPath;
        $validated["is_active"] = $validated["is_active"] ?? 0;

        Slider::create($validated);

        AlertService::created();

        return to_route("admin.sliders.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slider $slider)
    {
        return view("admin.dashboard.section.slider.edit", compact("slider"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Slider $slider)
    {
        $validated = $request->validate([
            'image' => ['nullable', 'image', 'max:2048'],
            'title' => ['required', 'string', 'max:255'],
            'sub_title' => ['required', 'string', 'max:255'],
            'btn_url' => ['nullable', 'string', 'max:255'],
            'is_active' => ['boolean', 'nullable'],
        ]);

        if ($request->hasFile("image")) {
            $logoPath = $this->uploadFile($validated['image'], $slider->image, "slider");
            $validated["image"] = $logoPath;
        }

        $validated["is_active"] = $request->has("is_active") ? 1 : 0;

        $slider->update($validated);

        AlertService::updated();

        return to_route("admin.sliders.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        $this->deleteFile($slider->image);

        $slider->delete();
        AlertService::deleted();
        return back();
    }
}
