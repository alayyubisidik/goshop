<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AlertService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::withCount("permissions")->get();
        return view("admin.dashboard.role.index", compact("roles"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all()->groupBy("group_name");
        return view("admin.dashboard.role.create", compact("permissions"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "role" => ["required", "string", "max:255", "unique:roles,name"],
            "permissions" => ["required", "array"]
        ]);


        $role = Role::create([
            "name" => $request->role,
            "guard_name" => "admin"
        ]);
        $role->syncPermissions($request->permissions);

        AlertService::created("Role Created Successfully");

        return to_route('admin.roles.index');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all()->groupBy("group_name");
        return view("admin.dashboard.role.edit", compact("role", "permissions"));
    }

    public function update(Request $request, Role $role)
    {
        if ($role->name == "Super Admin") {
            AlertService::error("You can not update Super Admin Role");
            return to_route("admin.roles.index");
        }

        $request->validate([
            "role" => ["required", "string", "max:255", "unique:roles,name," . $role->id],
            "permissions" => ["required", "array"]
        ]);

        $role->update(["name" => $request->role]);
        $role->syncPermissions($request->permissions);

        AlertService::updated();

        return to_route('admin.roles.index');
    }

    public function destroy(Role $role)
    {
        if ($role->name == "Super Admin") {
            return response()->json(["status" => "error", "message" => "You can not update Super Admin Role"]);
        }

        DB::beginTransaction();
        $role->users()->detach();
        $role->permissions()->detach();
        $role->delete();
        DB::commit();

        AlertService::deleted();

        return to_route('admin.roles.index');
    }
}
