<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Program;
Use App\Models\Campus;
use App\Models\User;
Use App\Models\Department;

class programsController extends Controller
{
    public function addProgram(){
        $data['title']='Add Program';
        $data['campuses'] = Campus::campusAll();
        $data['users'] = User::allUsers();
        $data['departments'] = Department::allDepartments();
        return view('admin.programs.addProgram' , $data);
    }

    public function createProgram(Request $request)
    {
        $validated = $request->validate([
            
            'program_code' => 'required|max:20',
            'program_name' => 'required|max:50',
            'duration' => 'required',
            'entry_level' => 'required|max:50',
            'coordinator' => 'required|max:50',
            'campus' => 'required',
            'department' => 'required|max:50',
            'award' => 'required|max:20',
            
        ]);
        // $sname = $request->short_name;
        // $pname = $request->program_name;
        $valid = Program::result($request->program_code, $request->program_name, $request->department);
       // $programname = Program::programName($request->program_name);

        if($validated)
        {
            if(!empty($valid))
            {
                return redirect()->back()->with('invalid', 'Program short name:' ." ".$request->short_name. " ".'already exist');
            }
          
                Program::create([
                    
                    'program_code' => $request->program_code,
                    'program_name' => $request->program_name,
                    'duration' => $request->duration,
                    'entry_level' => $request->entry_level,
                    'user_id' => $request->coordinator,
                    'campus_id' => $request->campus,
                    'department_id' => $request->department,
                    'award' => $request->award,
                ]);
    
                return redirect()->back()->with('status', 'Program' ." ".$request->program_name. " ".'added successfully');
            
           
        }

        
    }

    public function viewProgram(){
        $data['title']=' Programs List';
        $data['programs'] = Program::allPrograms();
        return view('admin.programs.viewProgram', $data);
    }

    public function editProgram($id)
    {   
        
        $data['title'] = 'Edit Program';
        $data['program'] = Program::getProgram($id);
        $data['title']='Edit Program';
        $data['campuses'] = Campus::campusAll();
        $data['users'] = User::allUsers();
        $data['departments'] = Department::allDepartments();
        
        return view('admin.programs.editProgram', $data);
    }

    public function updateProgram(Request $request, $id)
    {

        
    
           $myProgram = Program::getProgram($id);
          
           $myProgram->update([
                    'short_name' => $request->short_name,
                    'program_code' => $request->program_code,
                    'program_name' => $request->program_name,
                    'duration' => $request->duration,
                    'entry_level' => $request->entry_level,
                    'user_id' => $request->coordinator,
                    'department_id' => $request->department,
                    'campus_id' => $request->campus_offered,
                    'award' => $request->award,
           ]);
           return redirect()->back()->with('status', 'Program' ." ".$request->program_name. " ".'updated successfully');
        
        return redirect()->back()->with('status', 'something went wrong');
    }

}
