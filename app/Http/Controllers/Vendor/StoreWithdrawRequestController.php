<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\StoreWithdrawMethod;
use App\Models\StoreWithdrawRequest;
use App\Services\AlertService;
use Illuminate\Http\Request;

class StoreWithdrawRequestController extends Controller
{
    function index()
    {
        $store = user()->store;

        $withdrawRequests = StoreWithdrawRequest::whereStoreId($store->id)->get();

        $currentBalance = optional($store->wallet)->balance ?? 0;

        $pendingBalance = StoreWithdrawRequest::whereStoreId($store->id)
            ->whereStatus('pending')->sum('amount');

        $totalWithdraw = StoreWithdrawRequest::whereStoreId($store->id)
            ->whereStatus('paid')->sum('amount');

        return view('vendor.dashboard.withdraw-request.index', compact(
            'withdrawRequests',
            'currentBalance',
            'pendingBalance',
            'totalWithdraw'
        ));
    }

    function create()
    {
        $store = user()->store;

        $withdrawMethods = StoreWithdrawMethod::where("store_id", $store->id)->get();

        $currentBalance = optional($store->wallet)->balance ?? 0;

        $pendingBalance = StoreWithdrawRequest::whereStoreId($store->id)
            ->whereStatus('pending')->sum('amount');

        $totalWithdraw = StoreWithdrawRequest::whereStoreId($store->id)
            ->whereStatus('paid')->sum('amount');

        return view("vendor.dashboard.withdraw-request.create", compact(
            "withdrawMethods",
            "currentBalance",
            "pendingBalance",
            "totalWithdraw"
        ));
    }


    public function store(Request $request)
    {
        $request->validate([
            'method' => ['required', 'exists:store_withdraw_methods,id'],
            'amount' => ['required', 'numeric'],
        ]);

        $method = StoreWithdrawMethod::with('withdrawMethod')->find($request->method);
        $wallet = user()->store->wallet->balance ?? 0;
        $requestedAmount = (float) $request->amount;

        if (StoreWithdrawRequest::where("store_id", user()->store->id)->where("status", 'pending')->exists()) {
            AlertService::error('You have a pending withdraw request. You cannot create another until it is processed by admin.');
            return back();
        }

        if ($wallet < $requestedAmount) {
            AlertService::error('Insufficient balance.');
            return back();
        }

        if ($requestedAmount < $method->withdrawMethod->minimum_amount) {
            AlertService::error('Minimum withdraw amount is ' . $method->withdrawMethod->minimum_amount);
            return back();
        }

        if ($requestedAmount > $method->withdrawMethod->maximum_amount) {
            AlertService::error('Maximum withdraw amount is ' . $method->withdrawMethod->maximum_amount);
            return back();
        }

        $withdrawRequest = new StoreWithdrawRequest();
        $withdrawRequest->store_id = user()->store->id;
        $withdrawRequest->amount = $requestedAmount;
        $withdrawRequest->payment_method = $method->withdrawMethod->name;
        $withdrawRequest->payment_details = $method->description;
        $withdrawRequest->status = 'pending';
        $withdrawRequest->save();

        AlertService::created('Withdraw request created successfully.');

        return redirect()->route('vendor.withdraw-requests.index');
    }

    function destroy(StoreWithdrawRequest $withdraw_request)
    {
        abort_if($withdraw_request->store_id !== user()->store->id, 404);

        $withdraw_request->delete();
        AlertService::deleted();

        return back();
    }
}
