<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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

    public function addForgottenClassColumns()
    {
        $users = User::where('programclass','BSCES1')->get();
        foreach($users as $user)
        {
            $user->update(['class_id' => 38,
                            'campus_id' => 1,
                            ]);
        }
        if($user){return json_encode('success');} else{return json_encode('failed');}
    }

    public function resetStudentsPasswords()
    {
        set_time_limit(180); // Allow the script to run for 180 seconds
    
        $users = User::whereIn('programclass', ['DCM1', 'DCM2', 'DCM3'])->get();
    
        foreach ($users as $user) {
            $user->update(['password' => Hash::make('password')]);
        }
    
        return response()->json('success');
    }

    public function moveClassStudents()
    {
        $users = User::where('academicyear_id',1)
                      ->where('programclass', 'DEH1')
                      ->where('campus_id', 1)->where('semester',1)->get();

                      foreach($users as $user)
                      {
                        $result = $user->update([
                            'semester' => 2,
                        ]);
                      }
        if($result){return json_encode('success');} else{return json_encode('failed');}
    }
}




