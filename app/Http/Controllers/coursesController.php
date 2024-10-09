<?php

namespace App\Http\Controllers;

use App\Models\Academicyear;
use App\Models\classsubjects;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Course;
use App\Models\Studentsubject;
use App\Models\Myclasssubject;
use App\Models\Program;
use Illuminate\Support\Carbon;
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
        // get classes that are valid 

        $data['title'] = 'Allocate Subjects to Class';
        $data['classes'] = Programclass::all();
        // Fetch distinct combinations of class and semester which has students only.
        // $data['classCampuses'] = User::select('programclass', 'campus')
        // ->whereNotNull('programclass')
        // ->distinct()
        // ->get()
        // ->groupBy(['programclass', 'campus'])
        // ->map(function($group) {
        //     return $group->first();
        // })
        // ->values();

        // $data['classCampus'] = json_decode($data['classCampuses'], true); // Decode JSON to PHP associative array

        //dd($data['classCampus']);


        // $currentYear = Carbon::now()->year;
        // $data['ay'] = Academicyear::where('ayear',$currentYear)->get();
        
        return view('admin.courses.add_subject_to_class', $data);
    }

    public function classSubjects(Request $request)
    {
        $validated = $request->validate([
            'class_id' => 'required',
            'semester' => 'required',
        ]);

       // dd($request->class_id);
       $data['myClass'] = Programclass::findOrfail($request->class_id);
        
       $classCode = $data['myClass']->classcode;
       $classCampus = $data['myClass']->campus_id;
       $classSemester = $request->semester;
       $data['semester'] = $request->semester;

       if($classCampus==1) { $campus='Lilongwe'; }
       if($classCampus==2) { $campus='Blantyre'; }
       if($classCampus==3) { $campus='Zomba'; }

       $ay = User::where('programclass', $classCode)
            ->where('campus',$campus)
            ->where('semester',$classSemester)->first();

       $data['classAY'] = $ay->academicyear_id;


        if(!empty($validated))
        {
        $data['class'] = $request->class_id;
        $data['semester'] = $request->semester;
        $data['title'] = 'Subjects configurations';
       
        $data['classes'] = Programclass::all();
        $data['subjects'] = Course::all();

       // dd($data);
        return view('admin.courses.classSubjects', $data);
        }
       // dd($request->class_id);
        
       $data['title'] = 'Allocate Subjects to Class';
       $data['classes'] = Programclass::all();
       return view('admin.courses.add_subject_to_class', $data);
    }

    public function classSubjectsWithId(Request $request)
    {
        $data['class'] = $request->route('class_id');
        $data['semester'] = $request->route('semester');
        $data['myClass'] = Programclass::findOrfail($data['class']);
        
        $classCode = $data['myClass']->classcode;
        $classCampus = $data['myClass']->campus_id;
        $classSemester = $data['semester'];

        if($classCampus==1) { $campus='Lilongwe'; }
        if($classCampus==2) { $campus='Blantyre'; }
        if($classCampus==3) { $campus='Zomba'; }

        $ay = User::where('programclass', $classCode)
             ->where('campus',$campus)
             ->where('semester',$classSemester)->first();

        $data['classAY'] = $ay->academicyear_id;

        if(!empty($data['class']))
        {
        
        $data['title'] = 'Subjects configurations';
       
        $data['classes'] = Programclass::all();
        $data['subjects'] = Course::all();

        //dd($data['class'],$data['ay']);
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
        $data['semester'] = $request->semester;
        $data['title'] = 'Subject configurations';
        
        return view('admin.courses.configClassSubjects', $data);
    }

    public function configuredSubject(Request $request)
    {
        $validated = $request->validate([
             'exam_weight' => 'required',
             'ca_weight' => 'required',
             'pass_mark' => 'required',
             'is_major' => 'required',
             'is_project' => 'required',
             'category' => 'required',
             
        
         ]);

        //dd($request->all());
        $already = Myclasssubject::where('programclass_id',$request->class_id)
        ->where('course_id',$request->subject_id)
        ->where('semester', $request->semester)
        ->whereNull('academicyear_id')
        ->first();

        $subject = Course::find($request->subject_id);
        if($already)
        {
        return redirect(route('class.subjects.withID', ['class_id'=>$request->class_id, 'semester'=>$request->semester]))
        ->with('invalid', 'This Subject'.' '.$subject->name .' '.'already assigned to this class');
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
       
       ]);
    }
       
       return redirect(route('class.subjects.withID', ['class_id' => $request->class_id, 'semester' => $request->semester]))
       ->with('message', 'Subject'.' '.$subject->name .' '.'configured successfully');
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
    
            $data['mystudents'] = User::where('programclass',$classCode)
            ->where('semester',$data['semester'])
            ->where('campus',$myclass->campus->campus)
            ->count();
    
    
            $data['classSubjects'] = Myclasssubject::where('programclass_id', $data['class_id'])
            ->where('semester', $data['semester'])
            ->whereNull('academicyear_id')
            ->get(); 
           
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
    $data['title'] = 'Lecturer Courses';
    return view('admin.courses.lecturer_assigned_courses', $data);
}
    
public function addSubjectToOldStudents()
{
    $classes = Programclass::all();
    return view('admin.courses.add_subjects_to_oldstudents', compact('classes'));
}

public function addSubjectToOldclass()
{
    $classes = Programclass::all();
    return view('admin.courses.add_subjects_to_oldclass', compact('classes'));
}

public function storeSubjectToOldClass(Request $request)
{

   //dd($request->all());
    $data['title'] = 'Add Subjects to old class';
    $data['ay'] = $request->acyID;
    $data['myclass'] = $request->classID;
    $data['semester'] = $request->semester;
   
    $data['classes'] = Programclass::all();
    $data['subjects'] = Course::all();
   //dd($request->all());
    return view('admin.grades.assign_modules_to_oldclass', $data);


}

public function storeSubjectToOldStudents(Request $request)
{
   // dd($request->all());
    $data['title'] = 'Add Subjects to old students';
    $data['ay'] = $request->acyID;
    $data['class'] = $request->classID;
    //$data['campus'] = $request->campus;
    $data['semester'] = $request->semester;

   
    $data['classes'] = Programclass::all();
    $data['subjects'] = Course::all();

    ////// from somewhere ....

    /////
    return view('admin.courses.select_subjects_to_oldstudents', $data);
}

public function allocateSubjectToOldStudents($class, $semester,$campus, $ay)
{
   $stuCampus=$campus;
   $myCampus = $campus;
  // $classCampus = Campus::find($campus);
   $classID = Programclass::where('id', $class)->first();
   $classCode = $classID->classcode;
   $classProgramID = $classID->program_id;
  
   $classSubjects = Myclasssubject::where('programclass_id', $class)
   ->where('semester', $semester)
   ->where('academicyear_id', $ay)
   ->where('classcode', $classID->classcode)
   ->get();

   

   //$singleSubject = $classSubjects->first();
  
   //dd($class, $semester, $ay,  $campus);
  // $classcampus = Campus::find($campus);
   // dd($classID->campus_id);
    $campusname = $classID->campus_id;
    if($campusname==1)
    {
        $campusname= 'Lilongwe';  
    }
    elseif($campusname==2)
    {
        $campusname= 'Lilongwe';  
    }
    else
    {
        $campusname= 'Zomba';  
    }

   $classCode = $classID->classcode;
   //$campusname = $campus->campus;
   
   $classStudents = User::where('programclass', $classCode)
   ->where('program_id',$classProgramID)
   ->where('semester', $semester)
   ->where('campus', $campusname)
   ->where('academicyear_id', $ay)
   ->get();
   //dd($class, $semester, $ay);
  // dd($class, $semester, $ay,  $campusname);
   $singleStudent = $classStudents->first();

   //dd($classSubjects, $classStudents);
   if(($singleStudent))
   {


   if(!empty($classSubjects) && !empty($classStudents)){
     // creating pivot table for Students and Subjects
   foreach ($classStudents as $classStudent) {
     // Attaching Subjects by id
         $classStudent->myclasssubject()->sync($classSubjects->pluck('id'));
     // Save the student object after attaching all subjects
     $classStudent->save();
 }
 
 // Save students subjects to another table.

 foreach ($classStudents as $classStudent) {
   foreach ($classSubjects as $subject) {
       $subStudent = Studentsubject::firstOrCreate(
           [
               'academicyr_id' => $classStudent->academicyear_id,
               'programclass_id' => $class,
               'semester' => $semester,
               'campus_id' => $stuCampus,
               'registration_no' => $classStudent->reg_num,
               'course_code' => $subject->course->code,
           ],
           [
               'assessment1' =>null,
               'assessment2' =>null,
               'exam_grade' =>null,
               'final_grade' =>null ,
           ]
       );
   }
}

 
 }
  $academicy = Academicyear::find($ay);
 return redirect(route('add.subject.to.old.students'))->with([
   'status' => 'Subjects assigned to Students under: ' . $classCode . ' | ' . $campusname .' ' .'| Semester: ' 
   . $semester. '|' . $academicy->ayear .' '.$academicy->month. ' '. $academicy->description ,
   'class_id' => $class,
   'campus' => $myCampus,
   'semester' => $semester
       ]);
   
       }

       else{
         return redirect(route('add.subject.to.old.students'))->with([
          'invalid' => 'No Students found in this class and campus',
           'class_id' => $class,
           'campus' => $myCampus,
          'semester' => $semester
           ]);
       }
}

public function soreOldClassSubjects(Request $request)
{
    
    $data['ay'] = $request->ayID;
    $data['myclass'] = $request->classID;
    $data['semester'] = $request->semester;
    $data['subject_id'] = $request->subject_id;


    $data['title'] = 'Add Subjects to old class';
    
      
       $data['classes'] = Programclass::all();
       $data['subjects'] = Course::all();

   // dd($request->all());

    
        ////// add subjects to old class

        $already = Myclasssubject::where('programclass_id',$request->classID)
        ->where('academicyear_id',$request->ayID)
        ->where('course_id',$request->subject_id)
        ->where('semester', $request->semester)
        ->first();

       // dd($request->subject_id);
        if($already)
        {
        $data['invalid'] = 'This Subject already assigned to this old class';
        return view('admin.grades.assign_modules_to_oldclass', $data);
        //return redirect(route('store.old.class.subjects',$data))->with('invalid', 'This Subject already assigned to this class');
        }
        else{
       $myClass = Programclass::find($request->classID);
       Myclasssubject::create([
        'academicyear_id' => $request->ayID,
        'programclass_id' => $request->classID,
        'classcode' => $myClass->classcode,
        'course_id' => $request->subject_id,
        'semester' => $request->semester,
        'exam_weight' =>60,
        'ca_weight' =>40,
        'pass_mark' =>50,
        'is_major' =>0,
        'is_project' =>0,
        'category' => 1
       
       ]);

    }
       //dd($request->all());
       
      //dd($request->all());
       return view('admin.grades.assign_modules_to_oldclass', $data)->with('status', 'Subject assigned to class successfully');
    //return redirect(route('store.old.class.subjects',$request->classID));
        //////
}

public function editClassAssignedSubjects($subjectID, $classID, $semester)
{
    
    $data['class'] = Programclass::find($classID);
    $data['subj_class'] = Myclasssubject::find($subjectID);
    $data['subject'] = Course::find($data['subj_class']->course_id);
    $data['semester'] = $semester;
    $data['title'] = 'Edit Subject configurations';
    
    return view('admin.courses.editConfigClassSubjects', $data);
}



public function editConfiguredSubject(Request $request)
{
 
    $validated = $request->validate([
        'exam_weight' => 'required',
        'ca_weight' => 'required',
        'pass_mark' => 'required',
        'is_major' => 'required',
        'is_project' => 'required',
        'category' => 'required',
        
   
    ]);

   //dd($request->all());
   $updateSubj = Myclasssubject::find($request->MyclassSubID);

   $subject = Course::find($request->subject_id);
   if($updateSubj)
   {
    $myClass = Programclass::find($request->class_id);
    $updateSubj->update([
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
  
  ]);

  return redirect(route('class.subjects.withID', ['class_id' => $request->class_id, 'semester' => $request->semester]))->with('message', 'Subject'.' '.$subject->name .' '.'updated successfully');

   }
   else
   {
   
    return redirect(route('class.subjects.withID', ['class_id'=>$request->class_id, 'semester'=>$request->semester]))
    ->with('invalid', 'This Subject'.' '.$subject->name .' '.'can not be updated.');
   }
  
  
}

public function deleteClassAssignedSubjects($subjectID, $classID, $semester, $ay)
{       
   // dd($subjectID, $classID, $semester, $campus_id);
   $myClassSubject = Myclasssubject::find($subjectID); // delete
   $studentSubj = $myClassSubject->course_id;

   // dd($subjectID,$studentSubj); same
   $stuCourse = Course::find($studentSubj);

   $studentsClass = Programclass::find($classID);
   $sclasscampus = $studentsClass->campus_id;
   if($sclasscampus==1){ $campus = 'Lilongwe'; }
   if($sclasscampus==2){ $campus = 'Blantyre'; }
   if($sclasscampus==3){ $campus = 'Zomba'; }


                $myClassSubject = Myclasssubject::find($subjectID); // delete
                $studentSubj = $myClassSubject->course_id;

               // dd($subjectID,$studentSubj); same
                $stuCourse = Course::find($studentSubj);



     if(!empty($stuCourse))
        {
            $studentSubjects = Studentsubject::where('academicyr_id',$ay)
            ->where('programclass_id',$classID)
            ->where('semester', $semester)
            ->where('course_code', $stuCourse->code)
            ->where('campus_id', $studentsClass->campus_id)->get();

            $subjectsWithGrades = $studentSubjects->filter(function ($subject) {
                return !empty($subject->assessment1) ||
                       !empty($subject->assessment2) ||
                       !empty($subject->exam_grade) ||
                       !empty($subject->final_grade);   // Filter out subjects with non-empty assessment1
            });

            if ($subjectsWithGrades->isEmpty()) {
                        
                    foreach($studentSubjects as $stuSubjects) 
                        {
                            
                            $stuSubjects->delete();
                        }

                            if(!empty($myClassSubject))
                            {
                                $myClassSubject->delete(); 
                            }

                            return redirect(route('class.subjects.withID', ['class_id' => $classID, 'semester' => $semester]))
                            ->with('message', 'Subject: '.' '.$stuCourse->name .' '.'deleted successfully');
                    }

                   
                    return redirect(route('class.subjects.withID', ['class_id' => $classID, 'semester' => $semester]))
                            ->with('message', 'Nothing deleted, this subject has grades.'); 
                    
        }
      
        
        return redirect(route('class.subjects.withID', ['class_id' => $classID, 'semester' => $semester]))
        ->with('message', 'Nothing deleted, something strange..'); 
  
}

public function deleteClassAndStudentsAssignedSubjects($ay, $subjectID, $classID, $semester)
{
    $myClassSubject = Myclasssubject::find($subjectID); // delete
    $studentSubj = $myClassSubject->course_id;

    $studentsClass = Programclass::find($classID);
    $sclasscampus = $studentsClass->campus_id;
    if($sclasscampus==1){ $campus = 'Lilongwe'; }
    if($sclasscampus==2){ $campus = 'Blantyre'; }
    if($sclasscampus==3){ $campus = 'Zomba'; }
    

    // dd($subjectID,$studentSubj); same
    $stuCourse = Course::find($studentSubj);

    if(!empty($stuCourse))
        {
            $studentSubjects = Studentsubject::where('academicyr_id',$ay)
            ->where('programclass_id',$classID)
            ->where('semester', $semester)
            ->where('course_code', $stuCourse->code)
            ->where('campus_id', $studentsClass->campus_id)->get();

            $subjectsWithGrades = $studentSubjects->filter(function ($subject) {
                return !empty($subject->assessment1) ||
                       !empty($subject->assessment2) ||
                       !empty($subject->exam_grade) ||
                       !empty($subject->final_grade);  // Filter out subjects with non-empty assessment1
            });

            if ($subjectsWithGrades->isEmpty()) {
                        
                    foreach($studentSubjects as $stuSubjects) 
                        {
                            
                            $stuSubjects->delete();
                        }

                            if(!empty($myClassSubject))
                            {
                                $myClassSubject->delete(); 
                            }

                     
                            return redirect(route('modules.to.students2'))->with([
                                'status' => 'Subject deleted for students under: ' . $studentsClass->classcode . ' | ' .$campus. '-Campus Semester: ' . $semester,
                                'class_id' => $classID,
                                'campus' => $studentsClass->campus_id,
                                'semester' => $semester
                                    ]);
                    }

                   
                    return redirect(route('modules.to.students2'))->with([
                        'invalid' => 'There are grades in this subject for: ' . $studentsClass->classcode . ' | ' .$campus. '-Campus Semester: ' . $semester,
                        'class_id' => $classID,
                        'campus' => $studentsClass->campus_id,
                        'semester' => $semester
                            ]);    
                    
        }
      
        
        return redirect(route('modules.to.students2'))->with([
            'invalid' => 'Something else for: ' . $studentsClass->classcode . ' | ' .$campus. '-Campus Semester: ' . $semester,
            'class_id' => $classID,
            'campus' => $studentsClass->campus_id,
            'semester' => $semester
                ]);   
   
   
}


}
