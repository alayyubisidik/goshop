<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Services\AlertService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Str;

class TagController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::paginate(20);
        return view('admin.dashboard.tag.index', compact("tags"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dashboard.tag.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => ["required", "string", "max:255", "unique:tags,name"]
        ]);

        $tag = new Tag();
        $tag->name = $request->name;
        $tag->slug = Str::slug($request->name);
        $tag->is_active = $request->has("status") ? 1 : 0;
        $tag->save();

        AlertService::created("Tag created successfully");

        return to_route("admin.tags.index");
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
    public function edit(Tag $tag)
    {
        return view("admin.dashboard.tag.edit", compact("tag"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            "name" => ["required", "string", "max:255", "unique:tags,name," . $tag->id]
        ]);

        $tag->name = $request->name;
        $tag->slug = Str::slug($request->name);
        $tag->is_active = $request->has("status") ? 1 : 0;
        $tag->save();

        AlertService::updated('Tag updaated successfully');

        return to_route("admin.tags.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        AlertService::deleted();

        return back();
    }
}
