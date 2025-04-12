<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

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
            $already = Permission::where('name', $request->name)->first();
            if(!empty($already))
            {
                return redirect()->back()->with('invalid', 'Permission:'.' ' .$request->name.' ' .'already exist in the system.');  
            }else{
                $permission = new Permission();
                $permission->name = $request->name;
                $permission->description = $request->description;
                $permission->save();
            }
            return redirect()->back()->with('status', 'Permission:'.' ' .$request->name.' ' .'created successfully'); 
        }

       
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
            'permission' => 'nullable|array',
            'permission.*' => 'exists:permissions,name' // Ensure each permission exists if provided
        ]);
    
        $role = Role::findOrFail($id);
    
        try {
            $permissions = $request->permission ?? []; // Default to an empty array if no permissions are provided
            $role->syncPermissions($permissions);
    
            return redirect()->back()->with(
                'status',
                'Permissions for role "' . $role->name . '" updated successfully.'
            );
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(
                'An error occurred while updating permissions: ' . $e->getMessage()
            );
        }
    } // end function

    public function userPermissions($id)
    {
        $user = User::findOrFail($id);
        if(!empty($user))
        {
            $permissions = Permission::all();
            $userPermissions = $user->getAllPermissions();
            return view('admin.permission.user_permissions', compact('user', 'permissions', 'userPermissions'));
        }
    } // end function

    public function directUserPermissions(Request $request, $id)
    {
        // Assume $user is an instance of the User model
            $user = User::findOrFail($id);

            // Define the permissions you want to assign
            $permissions = $request->permission;

                if (!empty($id)) 
                {
                    $user->syncPermissions($permissions);
                }
            
            return redirect()->back()->with('status', 'Permissions for user:'.' ' .$user->fname.' '.$user->lname. ' '.'successfully updated');
    }
}
