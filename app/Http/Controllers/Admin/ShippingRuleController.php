<?php

namespace App\Http\Controllers\Admin;

use App\Models\ShippingRule;
use Illuminate\Http\Request;
use App\Services\AlertService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ShippingRuleStoreRequest;

class ShippingRuleController extends Controller
{
   public function index()
    {
        $shippingRules = ShippingRule::all();
        return view("admin.dashboard.shipping-rule.index", compact("shippingRules"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.dashboard.shipping-rule.create");
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(ShippingRuleStoreRequest $request)
    {
        ShippingRule::create($request->validated());
        AlertService::created();
        return redirect()->route("admin.shipping-rules.index");
    }


    public function edit(ShippingRule $shippingRule)
    {
        return view("admin.dashboard.shipping-rule.edit", compact("shippingRule"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ShippingRuleStoreRequest $request, ShippingRule $shippingRule)
    {
        $validated = $request->validated();
        // dd($validated);

        $shippingRule->name = $validated["name"];
        $shippingRule->type = $validated["type"];
        if ($validated["minimum_amount"]) {
            $shippingRule->minimum_amount = $validated["minimum_amount"];
        }
        $shippingRule->charge = $validated["charge"];
        $shippingRule->is_active = $validated["is_active"] ?? 0;
        $shippingRule->save();
        AlertService::updated();
        return redirect()->route("admin.shipping-rules.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShippingRule $shippingRule)
    {
        $shippingRule->delete();
        AlertService::deleted();
        return back();
    }
}
