<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class permissionController extends Controller
{
    public function listPermissions()
    {
        return view('admin.permission.listPermissions');
    }

    public function addPermission()
    {
        return view('admin.permission.addPermission');
    }

    public function assignPermissions()
    {
        return view('admin.permission.assignPermissions');
    }
}
