<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FlashSale;
use App\Models\Product;
use App\Services\AlertService;
use Illuminate\Http\Request;

class FlashSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */ public function index()
    {
        $flashSale = FlashSale::first();
        $products = Product::whereIn('id', $flashSale?->products ?? [])->get();
        return view('admin.dashboard.section.flash-sale.index', compact('flashSale', 'products'));
    }

    function getProducts(Request $request)
    {
        $products = Product::where('name', 'LIKE', '%' . $request->q . '%')->paginate(20);

        $requests = $products->map(function ($product) {
            return [
                'id' => $product->id,
                'text' => $product->name,
                'image' => asset($product->primaryImage->path)
            ];
        });

        return response()->json([
            'results' => $requests,
            'pagination' => [
                'more' => $products->hasMorePages()
            ]
        ]);
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
        $data = $request->validate([
            'sale_start' => 'required|date',
            'sale_end' => 'required|date',
            'products' => 'required|array',
            'is_active' => ['nullable', 'boolean'],
        ]);
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        FlashSale::updateOrCreate(
            ['id' => 1],
            $data
        );

        AlertService::updated();
        return back();
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
