<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StoreWallet;
use App\Models\StoreWithdrawRequest;
use App\Services\AlertService;
use Illuminate\Http\Request;

class WithdrawRequestController extends Controller
{
    public function index()
    {
        $withdrawRequests = StoreWithdrawRequest::paginate(30);
        return view('admin.dashboard.withdraw-request.index', compact('withdrawRequests'));
    }

    public function show(StoreWithdrawRequest $withdraw_request)
    {
        return view('admin.dashboard.withdraw-request.show', compact('withdraw_request'));
    }

    public function update(StoreWithdrawRequest $withdraw_request, Request $request)
    {
        $withdraw_request->status = $request->status;
        $withdraw_request->save();

        if ($withdraw_request->status == 'paid') {
            $storeWallet = StoreWallet::whereStoreId($withdraw_request->store_id)->first();
            $storeWallet->balance -= $withdraw_request->amount;
            $storeWallet->save();
        }

        AlertService::updated();

        return redirect()->route('admin.withdraw-requests.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
