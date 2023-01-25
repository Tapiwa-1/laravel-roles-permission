<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return Inertia::render('Admin/Users/Index', compact('users'));
    }

    public function show(User $user){
        $allRoles = Role::all();
        $assignedRoles = $user->roles;
        $allPermissions = Permission::all();
        $assignedPermissions = $user->getAllPermissions();
        $userDetails = $user;
        // dd($assignedPermissions);
        return Inertia::render('Admin/Users/EditRole', compact('userDetails','allRoles','allPermissions','assignedRoles','assignedPermissions'));
    }
    public function assignRole(Request $request, User $user)
    {
        if ($user->hasRole($request->roleName)) {
            return back()->with('message', 'Role exists.');
        }

        $user->assignRole($request->roleName);
        return back()->with('message', 'Role assigned.');
    }

    public function removeRole(User $user, Role $role)
    {
        if ($user->hasRole($role)) {
            $user->removeRole($role);
            return back()->with('message', 'Role removed.');
        }

        return back()->with('message', 'Role not exists.');
    }

    public function givePermission(Request $request, User $user)
    {
        if ($user->hasPermissionTo($request->permissionName)) {
            return back()->with('message', 'Permission exists.');
        }
        $user->givePermissionTo($request->permissionName);
        return back()->with('message', 'Permission added.');
    }

    public function revokePermission(User $user, Permission $permission)
    {
        if ($user->hasPermissionTo($permission)) {
            $user->revokePermissionTo($permission);
            return back()->with('message', 'Permission revoked.');
        }
        return back()->with('message', 'Permission does not exists.');
    }

    public function destroy(User $user)
    {
        if ($user->hasRole('admin')) {
            return back()->with('message', 'you are admin.');
        }
        $user->delete();
        return back()->with('message', 'User deleted.');
    }
}
