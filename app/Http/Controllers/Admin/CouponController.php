<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CouponStoreRequest;
use App\Http\Requests\Admin\CouponUpdateRequest;
use App\Models\Coupon;
use App\Services\AlertService;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons = Coupon::paginate(20);

        return view("admin.dashboard.coupon.index", compact("coupons"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.dashboard.coupon.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CouponStoreRequest $request)
    {
        $data = $request->validated();

        Coupon::create($data);

        AlertService::created();

        return redirect()->route('admin.coupons.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coupon $coupon)
    {
        return view("admin.dashboard.coupon.edit", compact("coupon"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CouponUpdateRequest $request, Coupon $coupon)
    {
        $data = $request->validated();

        $coupon->code = $data['code'];
        $coupon->value = $data['value'];
        $coupon->is_percent = $data['is_percent'];
        $coupon->minimum_spend = $data['minimum_spend'];
        $coupon->maximum_spend = $data['maximum_spend'];
        $coupon->usage_limit_per_coupon = $data['usage_limit_per_coupon'];
        $coupon->usage_limit_per_customer = $data['usage_limit_per_customer'];
        $coupon->start_date = $data['start_date'];
        $coupon->end_date = $data['end_date'];
        $coupon->is_active = $data['is_active'] ?? false;

        $coupon->save();

        AlertService::updated();

        return redirect()->route('admin.coupons.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        AlertService::deleted();

        return back();
    }
}
