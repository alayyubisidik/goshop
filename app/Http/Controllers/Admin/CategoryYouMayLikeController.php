<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryYouMayLike;
use App\Models\ProductSection;
use App\Services\AlertService;
use Illuminate\Http\Request;

class CategoryYouMayLikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categoryYouMayLike = CategoryYouMayLike::first();
        return view("admin.dashboard.section.category-you-may-like.index", compact("categoryYouMayLike"));
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
            'category_one' => ['nullable', 'integer', 'exists:categories,id'],
            'category_two' => ['nullable', 'integer', 'exists:categories,id'],
            'category_three' => ['nullable', 'integer', 'exists:categories,id'],
        ]);

        CategoryYouMayLike::updateOrCreate(
            ['id' => 1],
            [
                'category_one' => $request->category_one,
                'category_two' => $request->category_two,
                'category_three' => $request->category_three
            ]
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
