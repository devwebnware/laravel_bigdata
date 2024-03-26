<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\RoleHasPermission;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::orderBy('name', 'asc')->get();
        return view('backend.role.index', compact('roles'));
    }
    public function create()
    {
        $permissions = Permission::orderBy('name', 'asc')->where('guard_name', 'web')->get();
        return view('backend.role.create', compact('permissions'));
    }
    public function store(Request $request)
    {
        $role = Role::where('name', strtolower($request->name))->where('guard_name', $request->guard_name)->first();
        if ($role) {
            return redirect()->back()->withInput()->with('error', 'Role with same name already exists.');
        } else {
            $role = new Role();
            $role->name = strtolower($request->name);
            $role->guard_name = $request->guard_name;
            if ($role->save()) {
                if ($request->permission) {
                    foreach ($request->permission as $permission) {
                        $fetchedPermission = Permission::where('name', $permission)->first();
                        $role->givePermissionTo($fetchedPermission);
                    }
                }
                return redirect()->route('role.index')->with('message', 'Role added successfully');
            } else {
                return redirect()->route('role.index')->with('error', 'An error occurred. Please try again.');
            }
        }
    }
    public function edit($id)
    {
        $role = Role::where('id', $id)->first();
        $permissions = Permission::orderBy('name', 'asc')->where('guard_name', $role->guard_name)->get();
        $roleHasPermissions = RoleHasPermission::where('role_id', $role->id)->get();
        return view('backend.role.edit', compact('role', 'permissions', 'roleHasPermissions'));
    }
    public function update(Request $request, $id)
    {
        $role = Role::where('id', $id)->first();
        if ($role->name == strtolower($request->name)) {
            $role->name = strtolower($request->name);
            $role->guard_name = $request->guard_name;
            if ($role->update()) {
                DB::table('role_has_permissions')->where('role_id', $role->id)->delete();
                if ($request->permission) {
                    foreach ($request->permission as $permission) {
                        $fetchedPermission = Permission::where('name', $permission)->first();
                        $role->givePermissionTo($fetchedPermission);
                    }
                }
                return redirect()->route('role.index')->with('message', 'Role updated successfully');
            } else {
                return redirect()->route('role.index')->with('error', 'An error occurred. Please try again.');
            }
        } else {
            $existingRole = Role::where('name', strtolower($request->name))->where('guard_name', $request->guard_name)->first();
            if ($existingRole) {
                return redirect()->back()->with('error', 'Role with same name already exists.');
            } else {
                $role->name = strtolower($request->name);
                $role->guard_name = strtolower($request->guard_name);
                if ($role->update()) {
                    return redirect()->route('role.index')->with('message', 'Role updated successfully');
                } else {
                    return redirect()->route('role.index')->with('error', 'An error occurred. Please try again.');
                }
            }
        }
    }

    public function fetchPermission(Request $request)
    {
        $permissions = Permission::where('guard_name', $request->name)->select('id', 'name')->get();
        return response()->json(['data' => $permissions], 200);
    }
}
