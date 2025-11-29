<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomPage;
use App\Services\AlertService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CustomPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pages = CustomPage::paginate(30);
        return view('admin.dashboard.custom-page.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dashboard.custom-page.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255', 'unique:custom_pages,title'],
            'content' => ['required', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ]);
        $data['slug'] = Str::slug($data['title']);
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        CustomPage::create($data);

        AlertService::created();
        return redirect()->route('admin.custom-pages.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CustomPage $customPage)
    {
        return view('admin.dashboard.custom-page.edit', compact('customPage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CustomPage $customPage)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255', 'unique:custom_pages,title,' . $customPage->id],
            'content' => ['required', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ]);
        $data['slug'] = Str::slug($data['title']);
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        $customPage->update($data);

        AlertService::updated();
        return redirect()->route('admin.custom-pages.index');
    }

    public function destroy(CustomPage $custom_page)
    {
        $custom_page->delete();

        AlertService::deleted();
        return back();
    }
}
