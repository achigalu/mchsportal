<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

use Illuminate\Http\Request;

class permissionController extends Controller
{
    public function listPermissions()
    {
        $permissions = Permission::all();
        return view('admin.permission.listPermissions', compact('permissions'));
    }

    public function addPermission()
    {
        return view('admin.permission.addPermission');
    }

    public function assignPermissions($id)
    {   
        $role = Role::find($id);
        $rolePermissions = $role->permissions;
        if(!empty($role))
        {
            $permissions = Permission::all();
            return view('admin.permission.assignPermissions', compact('role', 'permissions', 'rolePermissions'));
        }

    } //end function

    public function storePermission(Request $request)
    {
        $validated = $request->validate([
            'name' =>'required',
            'description' =>'required',
        ]);

        if($validated)
        {
            $permission = new Permission();
            $permission->name = $request->name;
            $permission->description = $request->description;
            $permission->save();
        }

        return redirect()->back()->with('status', 'Permission:'.' ' .$request->name.' ' .'created successfully');
    } //end function

    public function editPermission($id)
    {
        $permission = Permission::find($id);
        if(!empty($permission))
        {
            return view('admin.permission.edit_permission', compact('permission'));
        }
    } // end function

    public function updatePermission(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string'
        ]);

        $permission = Permission::find($id);
        if(!empty($permission))
        {
            $permission->update([
                'name' => $request->name,
                'description' => $request->description
            ]);
        }
        return redirect()->back()->with('status', 'Permission:'.' ' .$request->name.' ' .'updated successfully');
    } // end function

    public function permissionsToaRole(Request $request, $id)
    {
        $request->validate([
            'permission' =>'required'
        ]);

        $role = Role::find($id);
        $permissions = $request->permission;
        //dd($permissions);
        if(!empty($role))
        {
            $role->syncPermissions($permissions);
            return redirect()->back()->with('status', 'Permissions for role:'.' ' .$role->name.' ' .'updated successfully');
        }
    }
}
