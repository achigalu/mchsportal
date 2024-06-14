<?php

namespace App\Http\Controllers;

use App\Models\Feecategory;
use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\Programclass;
use App\Models\User;

class programClassController extends Controller
{
    public function viewProgramClasses($id, $campus){
        $data['title'] = 'Program Classes';
        $data['class_program'] = Program::getProgram($id);
        $data['classeslist'] = Programclass::where('program_id',$id)->get();
        $data['campus'] = $campus;
        
        return view('admin.programs.viewProgramClasses', $data);
    }

    public function editProgramClass($id){
        $data['title'] = 'Edit Program Class';
        $data['pclass'] = Programclass::where('id',$id)->first();

        //dd($data['pclass']);
        return view('admin.programs.editProgramClass', $data);
    }

    public function addProgramClass($pclass, $pcampus){
        $data['class_coordinator'] = User::allUsers();
        $data['title']='Add class to program';
        $data['program_class'] = Program::getProgram($pclass);
        $data['feecategory'] = Feecategory::all();
        $data['pcampus'] = $pcampus;
        return view('admin.programs.addProgramClass', $data);
    }

    public function createProgramClass(Request $request , $id)
    {
        //dd($request->all());
        $request->validate([
            'classcode' =>'required',
            'classname' =>'required',
            'class_coordinator' => 'required',
            'campus' => 'required',
            'basic' => 'required',
            'feecategory' =>'required',
            'classyear' =>'required',
        ]);
        $campus = $request->campus;
        $already = Programclass::where('classcode', $request->classcode)->where('classname',$request->classname)->where('campus_id',$campus)->first();
        if($already)
        {
            return redirect()->back()->with('invalid','Class for ' .$request->classname. ' already exist');
        }
        else{
           
            Programclass::create([
                'classcode' => $request->classcode,
                'classname' =>  $request->classname,
                'classyear' => $request->classyear,
                'coordinator' => $request->class_coordinator,
                'feecategory_id' => $request->feecategory,
                'under_basic' => $request->basic,
                'program_id' => $id,
                'campus_id' => $campus,
            ]);

            return redirect()->back()->with('status','Class for ' .$request->classname. ' created successfully');
        }
        return redirect()->back()->with('invalid','Something went wrong'); 
    }

    public function updateProgramClass(Request $request, $id)
    {
        //dd($request->all());
        $updateProgramClass = Programclass::find($id);

        // if basic=yes=1 : select coordinator of classes
        // if basic=no=0 : select coordinator of program
        if(!empty($updateProgramClass))
        {
            $updateProgramClass->update([
                'classcode' => request('scode'),
                'classname' => request('cname'),
                'classyear' => request('cyear'),
                'feecategory_id' => request('fcategory'),
                'program_id' => request('program_id'),
                'coordinator' => request('coordinator'),
                'campus_id' => request('campus_id'),
                'under_basic' => request('basic')]);
        }
        return redirect()->back()->with('status','Class for ' .$request->cname. ' updated successfully');
    }
}
