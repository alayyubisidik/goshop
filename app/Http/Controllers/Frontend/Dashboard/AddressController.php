<?php

namespace App\Http\Controllers\Frontend\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\AddressStoreRequest;
use App\Models\Address;
use App\Services\AlertService;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $addresses = Address::where("user_id", user()->id)->get();
        return view("frontend.dashboard.address.index", compact("addresses"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("frontend.dashboard.address.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddressStoreRequest $request)
    {
        $validated = $request->validated();

        if ($validated['is_default'] == 1) {
            Address::where('user_id', user()->id)->update(['is_default' => 0]);
        }

        $validated["user_id"] = user()->id;
        Address::create($validated);
        AlertService::created();
        return to_route("address.index");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Address $address)
    {
        return view("frontend.dashboard.address.edit", compact("address"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AddressStoreRequest $request, Address $address)
    {
        if ($address->user_id !== user()->id) {
            abort(403);
        }

        $validated = $request->validated();

        if ($validated['is_default'] == 1) {
            Address::where('user_id', user()->id)->update(['is_default' => 0]);
        }

        $address->update($validated);
        AlertService::updated();
        return to_route("address.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address)
    {
        abort_if($address->user_id !== user()->id, 403);

        $userId = $address->user_id;

        $address->delete();

        $remainingAddresses = Address::where('user_id', $userId)->get();

        if ($remainingAddresses->count() === 1) {
            $remaining = $remainingAddresses->first();
            if ($remaining->is_default != 1) {
                $remaining->update(['is_default' => 1]);
            }
        }

        AlertService::deleted("Address deleted successfully");
        return back();
    }
}
