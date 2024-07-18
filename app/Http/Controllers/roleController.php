<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Role;

use Illuminate\Http\Request;

class roleController extends Controller
{
   public function listRoles()
   {
   
   $data['roles'] = Role::all();
   return view('admin.role.listRoles', $data);
   }

   public function addRole()
   {
    return view('admin.role.addRole');
   } // end function

   public function storeRole(Request $request)
   {
      
      $validated = $request->validate([
           'name' =>'required|string',
           'description' =>'required|string',
       ]);

       if($validated)
       {
         $already = Role::where('name', $request->name)->first();
         if(!empty($already))
         {
            return redirect()->back()->with('invalid', 'Role:'.' '.$request->name.' '.'already exist');
         }else{
         $role = Role::create(['name' => $request->name, 'description' => $request->description]);
         $role->save();
         }
         
         return redirect()->back()->with('status', 'Role:'.' '.$request->name.' '.'Created Successfully'); 
       }
       
   } // end function

   public function editRole($id)
   {
      $role = Role::find($id);
      if(!empty($role))
      {
         return view('admin.role.edit_role', compact('role'));
      }

   } // end function

   public function updateRole(Request $request, $id)
   {
      $request->validate([
         'name' => 'required|string',
         'description' => 'required|string',
      ]);

      $role = Role::find($id);
      if(!empty($role))
      {
         $role->update([
            'name' => $request->name,
            'description' => $request->description,
         ]);
         return redirect()->back()->with('status', 'Role:'.' '.$request->name.' '.'Updated Successfully');
      }

   } // end function

   public function deleteRole()
   {
      echo "deleting role";
   } // end function
}
