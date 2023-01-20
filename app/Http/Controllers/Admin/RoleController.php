<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Summary of index
     * @return \Inertia\Response
     */
    public function index(){
        $roles = Role::all();
        return Inertia::render('Admin/Roles/Index',compact('roles'));
    }

    public function create(){
        return Inertia::render('Admin/Roles/Create');
    }
    public function store(Request $request){
        $validated = $request->validate(['name' => 'required']);
        Role::create($validated);

        return to_route('admin.roles.index')->with('message','role added successfully');
    }
    public function edit(Role $role){
        return Inertia::render('Admin/Roles/Edit',compact('role'));
    }
    public function update(Request $request, Role $role){
        $validated = $request->validate(['name' => 'required']);
        $role->update($validated);
        return to_route('admin.roles.index')->with('message','role edited successfully');
    }
    public function destroy(Role $role){
        $role->delete();
        return to_route('admin.roles.index')->with('message','role deleted successfully');
    }

}
