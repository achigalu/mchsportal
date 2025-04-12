<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faculty;
use App\Models\User;

class facultyController extends Controller
{
    public function addFaculty(){
        $data['record'] = User::allUsers();
        return view('admin.faculty.addFaculty', $data); 

    }

    public function createFaculty(Request $request){
        $validated = $request->validate([
            'faculty_name' => 'required|max:255',
            'faculty_dean_id' => 'required',
            'dd_faculty_dean_id' => 'nullable',
        ]);

        if($validated)
        {   
            $already = Faculty::where('faculty_name', $request->faculty_name)->first();
            if(!empty($already))
            {
                return redirect()->back()->with('invalid' , 'Faculty already Created');  
            }

            $faculty = new Faculty;
            $faculty->faculty_name = $request->faculty_name;
            $faculty->user_id = $request->faculty_dean_id;
            $faculty->dd_id = $request->dd_faculty_dean_id;
            $faculty->save();
        }
        return redirect()->back()->with('message' , 'Faculty Created Successully');
  
    }

    public function viewFaculty(){
        $data['faculties'] = Faculty::allFaculties();
        return view('admin.faculty.viewFaculty', $data);
    }

    public function editFaculty($id){
        $data['faculty'] = Faculty::myfaculty($id);
        $ded = $data['faculty']->dd_id;
        $data['editDean'] = User::find($ded);
        $data['allUsers'] = User::allUsers();
        return view('admin.faculty.editFaculty', $data);
    }

    public function updateFaculty(Request $request)
    {
        $validated = $request->validate([
            'facultyname' => 'required|max:255',
            'userID' => 'required',
            'dd_faculty_dean_id' => 'nullable'
        ]);
        
        $deanID = Faculty::find($request->facultyID);

        if($deanID)
        {
            $deanID->update([
                'user_id' => $request->userID,
                'faculty_name' => $request->facultyname,
                'dd_id' => $request->dd_faculty_dean_id
            ]);
        }
        return redirect()->back()->with('status' , 'Faculty Updated Successfully');
    }
}
