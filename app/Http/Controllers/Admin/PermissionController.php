<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
     public function index(){
        $permissions = Permission::all();
        return Inertia::render('Admin/Permissions/Index',compact('permissions'));
    }
     public function create(){
        return Inertia::render('Admin/Permissions/Create');
    }
    public function store(Request $request){
        $validated = $request->validate(['name' => 'required']);
        Permission::create($validated);

        return to_route('admin.permissions.index')->with('message','permission added successfully');
    }
    public function edit(Permission $permission,){
        $roles = Role::all();
        $assignedRole = $permission->roles;
        return Inertia::render('Admin/Permissions/Edit',compact('permission','roles','assignedRole'));
    }
     public function update(Request $request, Permission $permission){
        $validated = $request->validate(['name' => 'required']);
        $permission->update($validated);
        return to_route('admin.permissions.index')->with('message','permission edited successfully');
    }
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return to_route('admin.permissions.index')->with('message', 'permission deleted successfully');
    }
    public function assignRole(Request $request, Permission $permission)
    {
        if ($permission->hasRole($request->roleName)) {
            return back()->with('message', 'Role exists.');
        }

        $permission->assignRole($request->roleName);
        return back()->with('message', 'Role assigned.');
    }

    public function removeRole(Permission $permission, Role $role)
    {
        if ($permission->hasRole($role)) {
            $permission->removeRole($role);
            return back()->with('message', 'Role removed.');
        }

        return back()->with('message', 'Role not exists.');
    }
}
