<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialLink;
use App\Services\AlertService;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;

class SocialLinkController extends Controller
{
    use FileUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $socialLinks = SocialLink::all();
        return view('admin.dashboard.section.social-link.index', compact('socialLinks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dashboard.section.social-link.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'icon' => ['required', 'mimes:png,jpg,jpeg,svg', 'max:1048'],
            'url' => ['required', 'url'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $logoPath = $this->uploadFile($request->file("icon"), null, "social-icon");
        $validatedData['icon'] = $logoPath;
        $validatedData['is_active'] = $request->has('is_active') ?? 0;

        SocialLink::create($validatedData);

        AlertService::created();

        return to_route('admin.social-links.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SocialLink $socialLink)
    {
        return view('admin.dashboard.section.social-link.edit', compact('socialLink'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SocialLink $socialLink)
    {
        $validatedData = $request->validate([
            'icon' => ['nullable', 'mimes:png,jpg,jpeg,svg', 'max:1048'],
            'url' => ['required', 'url'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if ($request->hasFile('icon')) {
            $logoPath = $this->uploadFile($request->file("icon"), $socialLink->icon, "social-icon");
            $validatedData['icon'] = $logoPath;
        }
        $validatedData['is_active'] = $request->has('is_active') ? 1 : 0;

        $socialLink->update($validatedData);

        AlertService::updated();

        return to_route('admin.social-links.index');
    }

    public function destroy(SocialLink $socialLink)
    {
        $this->deleteFile($socialLink->icon);

        $socialLink->delete();
        AlertService::deleted();
        return response()->json(["status" => "success", "message" => "Social Link deleted successfully"]);
    }
}
