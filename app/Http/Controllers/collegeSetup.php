<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class collegeSetup extends Controller
{
    public function collegeSetup()
    {
        return view('admin.users.view_college_setup');
    }
}
