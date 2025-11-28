<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\StoreWithdrawMethod;
use App\Models\WithdrawMethod;
use App\Services\AlertService;
use Illuminate\Http\Request;

class StoreWithdrawMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $storeWithdrawMethods = StoreWithdrawMethod::where("store_id", user()->store->id)->get();
        return view("vendor.dashboard.withdraw-method.index", compact("storeWithdrawMethods"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $withdrawMethods = WithdrawMethod::where("is_active", 1)->get();
        return view("vendor.dashboard.withdraw-method.create", compact("withdrawMethods"));
    }

    public function store(Request $request)
    {
        $request->validate([
            'gateway' => ['required', 'integer', 'exists:withdraw_methods,id'],
            'description' => ['required', 'string', 'max:600']
        ]);

        $withdrawMethod = new StoreWithdrawMethod();
        $withdrawMethod->withdraw_method_id = $request->gateway;
        $withdrawMethod->description = $request->description;
        $withdrawMethod->store_id = user()->store->id;
        $withdrawMethod->save();

        AlertService::created();

        return to_route('vendor.withdraw-methods.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StoreWithdrawMethod $withdraw_method)
    {
        abort_if($withdraw_method->store_id !== user()->store->id, 403);
        $withdrawMethods = WithdrawMethod::where("is_active", 1)->get();
        return view("vendor.dashboard.withdraw-method.edit", compact("withdrawMethods", "withdraw_method"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreWithdrawMethod $withdraw_method, Request $request)
    {
        abort_if($withdraw_method->store_id !== user()->store->id, 403);
        $request->validate([
            'gateway' => ['required', 'integer', 'exists:withdraw_methods,id'],
            'description' => ['required', 'string', 'max:600']
        ]);

        $withdrawMethod = $withdraw_method;
        $withdrawMethod->withdraw_method_id = $request->gateway;
        $withdrawMethod->description = $request->description;
        $withdrawMethod->store_id = user()->store->id;
        $withdrawMethod->save();

        AlertService::updated();

        return to_route('vendor.withdraw-methods.index');
    }

    public function destroy(StoreWithdrawMethod $withdraw_method)
    {
        abort_if($withdraw_method->store_id !== user()->store->id, 404);

        $withdraw_method->delete();
        AlertService::deleted();

        return back();
    }
}
