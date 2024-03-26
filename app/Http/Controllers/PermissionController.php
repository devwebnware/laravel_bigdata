<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\RoleHasPermission;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::orderBy('name', 'asc')->get();
        return view('backend.permission.index', compact('permissions'));
    }
    public function create()
    {
        $roles = Role::orderBy('name', 'asc')->get();
        return view('backend.permission.create', compact('roles'));
    }
    public function store(Request $request)
    {
        $allPermissions = explode(',', $request->name);
        if ($allPermissions) {
            foreach ($allPermissions as $item) {
                $permission = Permission::where('name', strtolower(trim($item)))->first();
                if ($permission) {
                } else {
                    $permission = new Permission();
                    $permission->name = strtolower(trim($item));
                    $permission->guard_name = $request->guard_name;
                    if ($permission->save()) {
                        if ($request->role) {
                            foreach ($request->role as $role) {
                                $fetchedRole = Role::where('name', $role)->first();
                                $fetchedRole->givePermissionTo($permission);
                            }
                        }
                    }
                }
            }
            return redirect()->route('permission.index')->with('message', 'Permission added successfully');
        } else {
            return redirect()->route('permission.index')->with('error', 'An error occurred. Please try again.');
        }
    }

    public function edit($id)
    {
        $permission = Permission::where('id', $id)->first();
        $permissionForRoles = RoleHasPermission::where('permission_id', $permission->id)->get();
        $roles = Role::orderBy('name', 'asc')->get();
        return view('backend.permission.edit', compact('permission', 'roles', 'permissionForRoles'));
    }
    public function update(Request $request, $id)
    {
        $permission = Permission::where('id', $id)->first();
        if ($permission->name == strtolower($request->name)) {
            $permission->name = strtolower($request->name);
            $permission->guard_name = $request->guard_name;
            if ($permission->update()) {
                DB::table('role_has_permissions')->where('permission_id', $permission->id)->delete();
                if ($request->role) {
                    foreach ($request->role as $role) {
                        $fetchedRole = Role::where('name', $role)->first();
                        $fetchedRole->givePermissionTo($permission);
                    }
                }
                return redirect()->route('permission.index')->with('message', 'Permission updated successfully');
            } else {
                return redirect()->route('permission.index')->with('error', 'An error occurred. Please try again.');
            }
        } else {
            $existingPermission = Permission::where('name', strtolower($request->name))->first();
            if ($existingPermission) {
                return redirect()->back()->with('error', 'Permission with same name already exists.');
            } else {
                $permission->name = strtolower($request->name);
                $permission->guard_name = strtolower($request->guard_name);
                if ($permission->update()) {
                    return redirect()->route('permission.index')->with('message', 'Permission updated successfully');
                } else {
                    return redirect()->route('permission.index')->with('error', 'An error occurred. Please try again.');
                }
            }
        }
    }
}
