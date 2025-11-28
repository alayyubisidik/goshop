<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WithdrawMethodStoreRequest;
use App\Models\WithdrawMethod;
use App\Services\AlertService;
use Illuminate\Http\Request;

class WithdrawMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $withdrawMethods = WithdrawMethod::all();
        return view("admin.dashboard.withdraw-method.index", compact("withdrawMethods"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.dashboard.withdraw-method.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'instruction' => ['required', 'string', 'max:2000'],
            'minimum_amount' => ['required', 'numeric'],
            'maximum_amount' => ['required', 'numeric'],
            'is_active' => ['nullable', 'boolean'],
        ]);
        WithdrawMethod::create($data);
        AlertService::created();
        return redirect()->route('admin.withdraw-methods.index');
    }

    public function edit(WithdrawMethod $withdrawMethod)
    {
        return view("admin.dashboard.withdraw-method.edit", compact("withdrawMethod"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WithdrawMethod $withdrawMethod)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'instruction' => ['required', 'string', 'max:2000'],
            'minimum_amount' => ['required', 'numeric'],
            'maximum_amount' => ['required', 'numeric'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        // Jika checkbox 'is_active' tidak ada di request, set ke 0
        if (!$request->has('is_active')) {
            $data['is_active'] = 0;
        }

        $withdrawMethod->update($data);

        AlertService::updated();
        return redirect()->route('admin.withdraw-methods.index');
    }


    public function destroy(WithdrawMethod $withdrawMethod)
    {
        $withdrawMethod->delete();
        AlertService::deleted();

        return back();
    }
}
