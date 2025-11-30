<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OurFeature;
use App\Services\AlertService;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;

class OurFeatureController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ourFeatures = OurFeature::paginate(10);
        return view('admin.dashboard.section.our-feature.index', compact('ourFeatures'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dashboard.section.our-feature.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'icon' => ['required', 'image'],
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['required', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
        ]);


        $validated['icon'] = $this->uploadFile($request->file('icon'), null, 'feature-icon');
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;
        OurFeature::create($validated);

        AlertService::created();

        return to_route('admin.our-features.index');
    }

    public function edit(OurFeature $ourFeature)
    {
        return view('admin.dashboard.section.our-feature.edit', compact('ourFeature'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OurFeature $ourFeature)
    {
        $validated = $request->validate([
            'icon' => ['nullable', 'image'],
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['required', 'string', 'max:255'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if ($request->has('icon')) {
            $validated['icon'] = $this->uploadFile($request->file('icon'), $ourFeature->icon, 'feature-icon');
        }
        $validated['is_active'] = $request->has('is_active') ?? 0;
        $ourFeature->update($validated);

        AlertService::updated();

        return to_route('admin.our-features.index');
    }

    public function destroy(OurFeature $ourFeature)
    {
        $this->deleteFile($ourFeature->icon);

        $ourFeature->delete();
        AlertService::deleted();
        return response()->json(["status" => "success", "message" => "Feature deleted successfully"]);
    }
}
