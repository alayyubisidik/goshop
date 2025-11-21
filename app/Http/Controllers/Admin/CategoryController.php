<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    use FileUploadTrait;
    public function index()
    {
        return view("admin.dashboard.category.index");
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            "name" => ["required", "string", "max:255"],
            "slug" => ["required", "string", "max:255", "unique:categories,slug"],
            "parent_id" => ["nullable", "exists:categories,id"],
            "is_active" => ["boolean"],
            "is_featured" => ["boolean"],
            'image' => ['nullable', 'image', 'max: 2048'],
            'icon' => ['nullable', 'mimes:jpg,jpeg,png,gif,svg', 'max:1000'],

        ]);

        if ($data['parent_id'] ?? null) {
            $parent = Category::find($data["parent_id"]);
            $depth = 1;

            while ($parent && $parent->parent_id) {
                $depth++;
                $parent = $parent->parent;
                if ($depth >= 3) break;
            }

            if ($depth >= 3) {
                throw ValidationException::withMessages([
                    "parent_id" => "Maximum depth reached"
                ]);
            }
        }

        $data["position"] = Category::where("parent_id", $data["parent_id"] ?? null)->max("position") + 1;

        // handle images
        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadFile($request->file('image'), null, "category-image");
        }
        if ($request->hasFile('icon')) {
            $data['icon'] = $this->uploadFile($request->file('icon'), null, 'category-icon');
        }

        $category = Category::create($data);

        return response()->json(["success" => true, "message" => "Category created successfully", "category" => $category]);
    }

    public function update(Request $request, int $id)
    {
        $category = Category::findOrFail($id);

        $data = $request->validate([
            "name" => ["required", "string", "max:255"],
            "slug" => ["required", "string", "max:255", "unique:categories,slug," . $category->id],
            "parent_id" => ["nullable", "exists:categories,id"],
            "is_active" => ["boolean"],
            "is_featured" => ["boolean"],
            'image' => ['nullable', 'image', 'max: 2048'],
            'icon' => ['nullable', 'mimes:jpg,jpeg,png,gif,svg', 'max:1000'],

        ]);

        // Cek kedalaman (sama seperti sebelumnya)
        if ($data['parent_id'] ?? null) {
            $parent = Category::find($data["parent_id"]);
            $depth = 1;

            while ($parent && $parent->parent_id) {
                $depth++;
                $parent = $parent->parent;
                if ($depth >= 3) break;
            }

            if ($depth >= 3) {
                throw ValidationException::withMessages([
                    "parent_id" => "Maximum depth reached"
                ]);
            }
        }

        $data["is_active"] = $data["is_active"] ?? false;

        // handle images
        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadFile($request->file('image'), $category->icon, "category-image");
        }
        if ($request->hasFile('icon')) {
            $data['icon'] = $this->uploadFile($request->file('icon'), $category->image, 'category-icon');
        }

        $category->update($data);

        return response()->json([
            "success" => true,
            "message" => "Category updated successfully",
            "category" => $category
        ]);
    }


    public function updateOrder(Request $request)
    {
        try {
            $tree = $request->tree;
            DB::transaction(function () use ($tree) {
                $this->updateTree($tree, null);
            });

            return response()->json(['success' => true, 'message' => "Category order updated successfully"]);
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th->getMessage()], 500);
        }
    }

    function updateTree($nodes, $parentId)
    {
        foreach ($nodes as $position => $node) {
            $category = Category::find($node['id']);
            $category->update([
                "parent_id" => $parentId,
                "position" => $position
            ]);

            if (isset($node['children']) && is_array($node['children'])) {
                $this->updateTree($node['children'], $category->id);
            }
        }
    }

    function show(int $id)
    {
        $category = Category::findOrFail($id);
        return response()->json($category);
    }

    public function getNestedCategories()
    {
        $categories = Category::getNested();
        return response()->json($categories);
    }

    function destroy(int $id)
    {
        $category = Category::findOrFail($id);
        if ($category->children()->count() > 0) {
            return response()->json(["error" => true, "message" => "Category has children and cannot be deleted"]);
        }

        $this->deleteFile($category->icon);
        $this->deleteFile($category->image);

        $category->delete();
        return response()->json(["success" => true, "message" => "Category deleted successfully"]);
    }
}
