<?php

namespace App\Http\Controllers;

use App\Models\classsubjects;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Course;
use App\Models\Myclasssubject;
use App\Models\Program;
use App\Models\Programclass;
use App\Models\User;
use App\Models\Campus;
use Illuminate\Support\Facades\Session;
use App\Models\lecturerSubjects;

class coursesController extends Controller
{
    public function addCourse(){
        $data['departments'] = Department::allDepartments();
        return view('admin.courses.addCourse', $data);
    }

    public function storeCourses(Request $request)
    {
        $request->validate([
            'code' => 'required|max:255',
            'name' => 'required|max:255',
            'level' => 'required',
            'department_id' => 'required',
            'status' => 'required'

        ]);

        $code = $request->code;
        $name = $request->name;

        $alreadyCode = Course::alreadyCode($code);
        $alreadyCourseName = Course::alreadyCourseName($name);

        if(!empty($alreadyCode))
        {
            return redirect()->back()->with('invalid', 'Course code:'. $request->code." ".' exist in the system'); 
        }
        elseif(!empty($alreadyCourseName))
        {
            return redirect()->back()->with('invalid', 'Course name: ' .$request->name." ". 'exist in the system');
        }
        else
        {
            Course::create([
                'code' => $request->code,
                'department_id' =>$request->department_id,
                'name' => $request->name,
                'status' =>$request->status,
                'level' => $request->level
            ]);
        }
           

            return redirect()->back()->with('status', 'Course: '.$request->code. " "  .$request->name. ' created successfully');
        

    } 

    public function viewCourses(){

        $data['allCourses'] = Course::getAllCourses();
        return view('admin.courses.viewCourses' , $data);
    }


    public function editCourse($id){
        $data['departments'] = Department::allDepartments();
        $data['courseedit'] = Course::courseToEdit($id);
        return view('admin.courses.editCourses' , $data);
    }

    public function configuredCourse(){
        $data['page_title'] = 'Configured Subjects';
        return view('admin.courses.configured_courses', $data);
    }

    public function updateCourses(Request $request , $id){

     $request->validate([
            'code' => 'required|max:255',
            'name' => 'required|max:255',
            'level' => 'required',
            'department_id' => 'required',
            'status' => 'required'
        ]);

        if(!empty($id))
        {
            $mycourse = Course::courseToEdit($id);
            if(!empty($mycourse))
            {
               $mycourse->update([

                'code' => $request->code,
                'department_id' =>$request->department_id,
                'name' => $request->name,
                'status' =>$request->status,
                'level' => $request->level
               ]); 

            return redirect()->back()->with('message', 'Course: '.$request->code. " "  .$request->name. ' updated successfully');
            }

        }
        return redirect()->back()->with('invalid', 'Course not found of Code:' .$id);

    }

    public function addSubjectToClass()
    {
        $data['title'] = 'Allocate Subjects to Class';
        $data['classes'] = Programclass::all();
        return view('admin.courses.add_subject_to_class', $data);
    }

    public function classSubjects(Request $request)
    {
        $validated = $request->validate([
            'class_id' => 'required',
        ]);
        if(!empty($validated))
        {
        $data['class'] = $request->class_id;
        $data['title'] = 'Subjects configurations';
       
        $data['classes'] = Programclass::all();
        $data['subjects'] = Course::all();
        return view('admin.courses.classSubjects', $data);
        }
       // dd($request->class_id);
        
       $data['title'] = 'Allocate Subjects to Class';
       $data['classes'] = Programclass::all();
       return view('admin.courses.add_subject_to_class', $data);
    }

    public function classSubjectsWithId($id)
    {
        if(!empty($id))
        {
        $data['class'] = $id;
        $data['title'] = 'Subjects configurations';
       
        $data['classes'] = Programclass::all();
        $data['subjects'] = Course::all();
        return view('admin.courses.classSubjects', $data);
        }
       // dd($request->class_id);
        
       $data['title'] = 'Allocate Subjects to Class';
       $data['classes'] = Programclass::all();
       return view('admin.courses.add_subject_to_class', $data);
    }

    public function configClassSubjects(Request $request)
    {
        $data['class'] = Programclass::find($request->class_id);
        $data['subject'] = Course::find($request->subject_id);
        $data['title'] = 'Subject configurations';
        
        return view('admin.courses.configClassSubjects', $data);
    }

    public function configuredSubject(Request $request)
    {
        $validated = $request->validate([
             'semester' => 'required',
             'exam_weight' => 'required',
             'ca_weight' => 'required',
             'pass_mark' => 'required',
             'is_major' => 'required',
             'is_project' => 'required',
             'category' => 'required',
             'campus'   => 'required'
        
         ]);

        //dd($request->all());
        $already = Myclasssubject::where('programclass_id',$request->class_id)->where('course_id',$request->subject_id)
        ->where('semester', $request->semester)->where('campus_id',$request->input('campus'))->first();
        if($already)
        {
        return redirect(route('class.subjects.withID',$request->class_id))->with('invalid', 'This Subject already assigned to this class');
        }
        else{
        $myClass = Programclass::find($request->class_id);
       Myclasssubject::create([
        'programclass_id' => $request->class_id,
        'classcode' => $myClass->classcode,
        'course_id' => $request->subject_id,
        'semester' => $request->semester,
        'exam_weight' =>$request->exam_weight,
        'ca_weight' =>$request->ca_weight,
        'pass_mark' =>$request->pass_mark,
        'is_major' =>$request->is_major,
        'is_project' =>$request->is_project,
        'category' => $request->category,
        'campus_id' => $request->input('campus')
       ]);
    }

       return redirect(route('class.subjects.withID',$request->class_id))->with('message', 'Subject configured successfully');
    }

    public function addSubjectToStudent()
    {
        if(!empty(Session::get('class_id'))){
            $data['class_id'] = Session::get('class_id');
            $data['campus'] = Session::get('campus');
           $data['semester'] = Session::get('semester');
    
           $classID = Programclass::where('id', $data['class_id'])->first();
           $campus = Campus::where('id', $data['campus'])->first();
           $classCode = $classID->classcode;
           $campus = $campus->campus;
    
            $myclass = Programclass::find($data['class_id']);
    
            $data['mystudents'] = User::where('programclass',$classCode)->where('semester',$data['semester'])->where('campus',$myclass->campus->campus)->count();
    
    
            $data['classSubjects'] = Myclasssubject::where('programclass_id', $data['class_id'])->where('semester', $data['semester'])->where('campus_id', $data['campus'])->get(); 
           
            return view('admin.intake.add_subject_to_student', $data);
            
        }
        return view('admin.intake.add_subject_to_student');
    }

    public function addSubjectsToLecturers()
    {
        
        $class = Programclass::all();
        $subjectClass = Myclasssubject::all();
        $data = []; // Initialize the array to store matched classes

        // Group subjectClass by type
        $groupedByType = [];
        foreach ($subjectClass as $sClass) {
        $groupedByType[$sClass->type][] = $sClass;
        }

       foreach ($class as $pClass) {
       foreach ($groupedByType as $type => $sClasses) {
       foreach ($sClasses as $sClass) {
            // Assuming you're comparing the id properties or some relevant attribute
            if ($pClass->id == $sClass->programclass_id) {
                $data[] = $sClass;
                break; // Take only the first match for this type and $pClass
            }
        }
    }
}

// Display the matched data
        return view('admin.courses.assign_subjects_to_lecturers', ['data' => $data]);
    }

    public function lecturerCourses($id)
    {   
        $data['lecturerCourses'] = lecturerSubjects::where('userid', $id)->get();
        $data['title'] = 'Lecturer courses';
        return view('admin.courses.lecturer_assigned_courses', $data);
    }
    
}
