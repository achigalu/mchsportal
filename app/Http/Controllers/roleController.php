<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class roleController extends Controller
{
   public function listRoles()
   {
    return view('admin.role.listRoles');
   }

   public function addRole()
   {
    return view('admin.role.addRole');
   }
}
