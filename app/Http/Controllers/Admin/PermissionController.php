<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;

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
    public function edit(Permission $permission){
        return Inertia::render('Admin/Permissions/Edit',compact('permission'));
    }
     public function update(Request $request, Permission $permission){
        $validated = $request->validate(['name' => 'required']);
        $permission->update($validated);
        return to_route('admin.permissions.index')->with('message','permission edited successfully');
    }
    public function destroy(Permission $permission){
        $permission->delete();
        return to_route('admin.permissions.index')->with('message','permission deleted successfully');
    }
}
