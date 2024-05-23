<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Faculty;
use App\Models\Department;
use App\Models\Campus;

use Illuminate\Http\Request;

class academicDepartments extends Controller
{
    public function addDepartment($id){
        $data['record'] = User::allUsers();
        $data['faculty'] = Faculty::myfaculty($id);
        $data['campuses'] = Campus::campusAll();
        return view('admin.departments.addDepartment', $data);
    }


    public function viewDepartments($id){
        $data['departments'] = Department::facultyDepartments($id);
        $data['record'] = Faculty::myfaculty($id);
        return view('admin.departments.viewDepartment', $data);     
    }

    public function departmentStore(Request $request){
        
        $validated = $request->validate([
             'department_name' => 'required',
             'department_head_id' => 'required',
             'campus' => 'required'
        ]);
        
        if($validated)
        {
            $dname = Department::where('department_name', $request->department_name)->where('campus_id', $request->campus)->first();
           // $cname = Department::where('campus_id', $request->campus)->first();
            if(!empty($dname))
            {
                return redirect()->back()->with('invalid' , 'Department already exist');  
            }
            $department = new Department;
            $department->department_name = $request->department_name;
            $department->user_id = $request->department_head_id;
            $department->faculty_id = $request->faculty_id;
            $department->campus_id = $request->campus;
            $department->save();

            return redirect()->back()->with('success' , 'Department created successfully');  
        }
    }

    public function editDepartment($id)
    {
        $data['allUsers'] = User::allUsers();
        $data['departmentSingle'] = Department::getSingle($id);
        $data['faculties'] = Faculty::allFaculties();
        return view('admin.departments.editDepartment', $data);  
    }

    public function updateDepartment(Request $request)
    {
          $request->validate([
            'department_name' => 'required',
             'department_id' => 'required',
             'department_id' => 'required',
             'user_id' => 'required'
          ]);

          if(!empty($request->department_id))
          {
            $department = Department::getSingle($request->department_id);
            $department->update([
                'department_name' => $request->department_name,
                'user_id' => $request->user_id,
                'faculty_id' => $request->faculty_id,   
            ]);
            return redirect()->back()->with('success' , 'Department updated successfully');  
          }

          return redirect()->back()->with('invalid' , 'Something went wrong buddy');  
          

    }
}




