<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Services\AlertService;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserRoleController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userRoles = Admin::all();
        return view('admin.dashboard.user-role.index', compact("userRoles"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $roles = Role::all();
        return view("admin.dashboard.user-role.create", compact("roles"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => ["required", "string", "max:255"],
            "email" => ["required", "email", "max:255", "unique:admins,email"],
            "password" => ["required", "confirmed", "min:3"],
            "role" => ["required"]
        ]);

        $role = Role::findOrFail($request->role);

        if ($role->name === "Super Admin") {
            AlertService::error("You can not update Super Admin Role");
            return to_route("admin.user-roles.index");
        }

        // Create admin
        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Assign role
        $admin->assignRole($role);

        AlertService::created();

        return to_route("admin.user-roles.index");
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $user_role)
    {
        $admin = $user_role;
        $roles = Role::all();
        return view("admin.dashboard.user-role.edit", compact("user_role", "roles"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $user_role)
    {
        if ($user_role->hasRole("Super Admin")) {
            AlertService::error("You can not update Super Admin Role");
            return to_route("admin.user-roles.index");
        }
        $request->validate([
            "name" => ["required", "string", "max:255"],
            "email" => ["required", "email", "max:255", "unique:admins,email," . $user_role->id],
            "role" => ["required"]
        ]);


        $role = Role::findOrFail($request->role);

        $admin = $user_role;
        $admin->name = $request->name;
        $admin->email = $request->email;
        if ($request->password !== null) {
            $request->validate([
                "password" => ["required", "confirmed", "min:3"]
            ]);
            $admin->password = bcrypt($request->password);
        }
        $admin->save();

        $admin->syncRoles([$role]);

        AlertService::updated();

        return to_route("admin.user-roles.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $user_role)
    {
        if ($user_role->hasRole("Super Admin")) {
            AlertService::error("You can not delete Super Admin Role");
            return to_route("admin.user-roles.index");
        }

        $admin = $user_role;
        foreach ($admin->getRoleNames() as $role) {
            $admin->removeRole($role);
        }

        $admin->delete();

        AlertService::deleted();

        return to_route("admin.user-roles.index");
    }
}
