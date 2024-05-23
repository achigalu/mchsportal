<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campus;

class campusController extends Controller
{
    public function allCampuses(){
        $data['campuses'] = Campus::campusAll();
        return view('admin.campus.campusList', $data);
    }

     public function addCampuses(){
         return view('admin.campus.addCampus');
     }
    
    public function campusStore(Request $request){
       $validated = $request->validate([
            'campus' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase','email', 'max:255','unique:users'],
            'phone' => 'required|digits:10',
            'district' => ['required'],
        ]);

        if($validated)
        {
            $campus =new Campus;
            $campus->campus = $request->campus;
            $campus->email = $request->email;
            $campus->phone = $request->phone;
            $campus->district = $request->district;
            $campus->save();
        }
        return redirect()->back()->with('message', 'Campus Created Successfully');
           
    }

    // public function editCampus(){
    //     return view('admin.campus.editCampus');
    // }
}

