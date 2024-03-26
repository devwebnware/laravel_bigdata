<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'permission:user_read']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->hasPermissionTo('user_read')) {
            $users = User::with('roles')->orderBy('name', 'asc')->get();
            return view('backend.user.index', compact('users'));
        } else {
            return back()->with('error', 'Unauthorised Access');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->hasPermissionTo('user_create')) {
            $roles = Role::where('guard_name', 'web')->get();
            return view('backend.user.create', compact('roles'));
        } else {
            return back()->with('error', 'Unauthorised Access');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (auth()->user()->hasPermissionTo('user_create')) {
            if ($request->password == $request->confirm_password) {
                $user = new User();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = bcrypt($request->password);
                foreach ($request->role as $role) {
                    $user->assignRole($role);
                }
                if ($user->save()) {
                    return redirect()->route('user.index')->with('message', 'User Created Successfully');
                } else {
                    return redirect()->route('user.index')->with('message', 'An error occurred. Please try again.');
                }
            } else {
                return redirect()->route('user.index')->with('error', 'New Password and Confirm Password should be same. Please try again.');
            }
        } else {
            return back()->with('error', 'Unauthorised Access');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->user()->hasPermissionTo('user_update')) {
            $user = User::with('roles')->where('id', $id)->first();
            $userRole = $user->roles->pluck('name')->first();
            $roles = Role::where('guard_name', 'web')->get();
            return view('backend.user.edit', compact('user', 'userRole', 'roles'));
        } else {
            return back()->with('error', 'Unauthorised Access');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (auth()->user()->hasPermissionTo('user_update')) {
            $user = User::with('roles')->where('id', $id)->first();
            if ($user) {
                if ($request->password == $request->confirm_password) {
                    $user->name = $request->name;
                    $user->email = $request->email;
                    if ($request->password) {
                        $user->password = bcrypt($request->password);
                    }
                    if ($user->update()) {
                        return redirect()->route('user.index')->with('message', 'User Updated Successfully');
                    } else {
                        return redirect()->route('user.index')->with('message', 'An error occurred. Please try again.');
                    }
                } else {
                    return redirect()->route('user.index')->with('error', "New Password and Confirm Password doesn't match. Please check.");
                }
            } else {
                return redirect()->route('user.index')->with('message', 'An error occurred. Please try again.');
            }
        } else {
            return back()->with('error', 'Unauthorised Access');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->hasPermissionTo('user_delete')) {
            $user = User::where('id', $id)->first();
            if ($user->delete()) {
                return redirect()->route('user.index')->with('message', 'User Deleted Successfully');
            } else {
                return redirect()->route('user.index')->with('error', 'An error occurred. Please try again.');
            }
        } else {
            return back()->with('error', 'Unauthorised Access');
        }
    }

    public function assignRole(Request $request)
    {
        if (auth()->user()->hasPermissionTo('user_role')) {
            $user = User::where('id', $request->id)->first();
            if ($user) {
                if ($user->assignRole($request->role)) {
                    return redirect()->route('user.index')->with('message', 'Role assigned successfully');
                } else {
                    return redirect()->route('user.index')->with('error', 'An error occurred. Please try again.');
                }
            } else {
                return redirect()->route('user.index')->with('error', 'An error occurred. Please try again.');
            }
        } else {
            return back()->with('error', 'Unauthorised Access');
        }
    }
    public function revokeRole(Request $request)
    {
        if (auth()->user()->hasPermissionTo('user_role')) {
            $role = Role::where('name', $request->role)->first();
            if ($role) {
                if (DB::table('model_has_roles')->where('model_id', $request->id)->where('role_id', $role->id)->delete()) {
                    return redirect()->route('user.index')->with('message', 'Role revoked successfully');
                } else {
                    return redirect()->route('user.index')->with('error', 'An error occurred. Please try again.');
                }
            } else {
                return redirect()->route('user.index')->with('error', 'An error occurred. Please try again.');
            }
        } else {
            return back()->with('error', 'Unauthorised Access');
        }
    }
    public function forceDelete($id)
    {
        if (auth()->user()->hasPermissionTo('user_force_delete')) {
            $user = User::where('id', $id)->first();
            if ($user->forceDelete()) {
                return redirect()->route('user.index')->with('message', 'User Permanently Deleted.');
            } else {
                return redirect()->route('user.index')->with('error', 'An error occurred. Please try again.');
            }
        } else {
            return back()->with('error', 'Unauthorised Access');
        }
    }
}
