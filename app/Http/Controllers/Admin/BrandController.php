<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Services\AlertService;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
{

    use FileUploadTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::paginate(20);
        return view("admin.dashboard.brand.index", compact("brands"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.dashboard.brand.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            "brand_logo" => ["required", "image", "max:2048"],
            "name" => ["required", "string", "max:255", "unique:brands,name"],
        ]);

        $logoPath = $this->uploadFile($request->file("brand_logo"), null, "brand-logo");

        $brand = new Brand();
        $brand->name = $request->name;
        $brand->slug = Str::slug($request->name);
        $brand->image = $logoPath;
        $brand->is_active = $request->has("status") ? 1 : 0;
        $brand->save();

        AlertService::created();

        return to_route("admin.brands.index");
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
    public function edit(Brand $brand)
    {
        return view("admin.dashboard.brand.edit", compact("brand"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            "image" => [ "image", "max:2048"],
            "name" => ["required", "string", "max:255", "unique:brands,name," . $brand->id],
            "is_active" => ["boolean"]
        ]);

        $brand->name = $request->name;
        if ($request->hasFile("image")) {
            $logoPath = $this->uploadFile($request->file("image"), $brand->image, "brand-logo");
            $brand->image = $logoPath;
        }
        $brand->slug = Str::slug($request->name);
        $brand->is_active = $request->has("status") ? 1 : 0;
        $brand->save();

        AlertService::updated();

        return to_route("admin.brands.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        $this->deleteFile($brand->image);

        $brand->delete();
        AlertService::deleted();

        return back();
    }
}
