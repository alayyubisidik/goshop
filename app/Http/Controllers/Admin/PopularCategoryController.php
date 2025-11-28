<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\PopularCategory;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\AlertService;

class PopularCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = PopularCategory::first()?->categories ?? [];
        return view("admin.dashboard.section.popular-category.index", compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'categories' => 'required'
        ]);

        PopularCategory::updateOrCreate(
            ['id' => 1],
            ['categories' => $request->categories]
        );

        AlertService::updated();

        return redirect()->back();
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
