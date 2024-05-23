<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dashboard extends Controller
{
    public function index()
    {
       echo 'Logged in by Email';
    }

    public function show()
    {
        echo 'Logged in by Reg';
    }
}




