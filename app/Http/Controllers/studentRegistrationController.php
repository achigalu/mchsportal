<?php

namespace App\Http\Controllers;

use App\Models\Myclasssubject;
use App\Models\Programclass;
use App\Models\User;
use App\Models\Campus;
use App\Models\Course;
use App\Models\lecturerSubjects;
use App\Models\Studentsubject;
use Illuminate\Http\Request;
use App\Models\savedExamNumbers;
use App\Models\classExaMNumbers;

class studentRegistrationController extends Controller
{
  public function classList(){
    $classes = Programclass::all();
    $groupedClasses = [];
    
    if ($classes->isNotEmpty()) {
        foreach ($classes as $class) {
            $campusId = $class->campus_id;
            
            // Initialize the array for this campus_id if it doesn't exist
            if (!isset($groupedClasses[$campusId])) {
                $groupedClasses[$campusId] = [];
            }
            
            // Add the class to the array for this campus_id
            $groupedClasses[$campusId][] = $class;
        }
    }
    
    // Now you can use $groupedClasses as needed
    // For example, to create a search list of campus IDs:
    $campusList = array_keys($groupedClasses);

    return view('admin.registration.class_list', compact('classes', 'campusList'));
  }

  public function examClassList()
  {
    $classes = Programclass::all();
    $groupedClasses = [];
    
    if ($classes->isNotEmpty()) {
        foreach ($classes as $class) {
            $campusId = $class->campus_id;
            
            // Initialize the array for this campus_id if it doesn't exist
            if (!isset($groupedClasses[$campusId])) {
                $groupedClasses[$campusId] = [];
            }
            
            // Add the class to the array for this campus_id
            $groupedClasses[$campusId][] = $class;
        }
    }
    
    // Now you can use $groupedClasses as needed
    // For example, to create a search list of campus IDs:
    $campusList = array_keys($groupedClasses);

    return view('admin.registration.exam_class_list', compact('classes', 'campusList')); 
  }

  public function moduleRegister(){
    return view('admin.registration.module_register');
  }

  public function studentsConfirmation(){
    return view('admin.registration.students_confirmation');
  }

  public function modulesToStudents(Request $request)
  {
   
    $request->validate([
      'class' => 'required',
      'semester' => 'required'
    ]);
//dd($request->all());
    $data['class'] = $request->class;
    $data['semester'] = $request->semester;
    $data['ourclass'] = Programclass::find($request->class);
    $data['class_program'] = $data['ourclass']->program_id;
    $data['class_code'] = $data['ourclass']->classcode;
    
    return view('admin.intake.attach_subjects_to_students', $data);

  }
  public function allocateSubjectToStudents($class, $semester, $campus)
  {
    $stuCampus=$campus;
    $myCampus = $campus;
   // $classCampus = Campus::find($campus);
    $classID = Programclass::where('id', $class)->first();
   // dd($class, $semester, $campus, $ay);
    $classSubjects = Myclasssubject::where('programclass_id', $class)
    ->where('semester', $semester)
    ->whereNull('academicyear_id')
    ->where('classcode', $classID->classcode)
    ->get();

    //dd($classSubjects);

    //$singleSubject = $classSubjects->first();
   
    
    $campus = Campus::where('id', $campus)->first();
    $classCode = $classID->classcode;
    $campus = $campus->campus;
    
    $classStudents = User::where('programclass', $classCode)
    ->where('semester', $semester)
    ->where('campus', $campus)
    ->get();
    //dd($class, $semester, $ay);
    $singleStudent = $classStudents->first();
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
                'assessment1' => 46,
                'assessment2' => 50,
                'exam_grade' => 61,
                'final_grade' => 66,
            ]
        );
    }
}

  
  }
   
  return redirect(route('add.subject.to.students'))->with([
    'status' => 'Subjects assigned to Students under: ' . $classCode . ' | ' . $campus . '-Campus Semester: ' . $semester,
    'class_id' => $class,
    'campus' => $myCampus,
    'semester' => $semester
        ]);
    
        }

        else{
          return redirect(route('add.subject.to.students'))->with([
           'invalid' => 'No Students found in this class and campus',
            'class_id' => $class,
            'campus' => $myCampus,
           'semester' => $semester
            ]);
        }
  }

  public function ModulesToLecturers(Request $request)
  {
    //dd($request->all());
   // $data['myclassSubjects'] = Myclasssubject::where('programclass_id', $request->class_id)->where('semester', $request->semester)->get();
    if(!empty($request->class_id) && !empty($request->semester))
    {
      $myClassSubjects = Myclasssubject::ClassSubject($request->class_id, $request->semester);
      
      $data['myclassSubjects'] = $myClassSubjects;
      $data['class_id'] = $request->class_id;
      $data['semester'] = $request->semester;
      return view('admin.courses.assign_subjects_to_lecturers', $data);
    }
    else{
      return view('admin.courses.assign_subjects_to_lecturers')->with('invalid', 'No Subjects found for this class and semester');
    }
  }

  public function AllocateModulesToLecturers(Request $request)
    
    {
      //dd($request->all());
      $myClassSubjects = Myclasssubject::ClassSubject($request->class_id, $request->semester);
      
      $data['myclassSubjects'] = $myClassSubjects;
      $data['class_id'] = $request->class_id;
      $data['semester'] = $request->semester;
      $data['campus'] = Programclass::find($request->class_id);
      $data['courseID'] = Course::find($request->course_id);
      if(!empty($request->class_id) && !empty($request->semester))
      {
        $lecturerSubject = lecturerSubjects::firstOrCreate(
          [
          'classid' => $request->class_id,
          'semester' => $request->semester,
          'campus_id' => $data['campus']->campus_id,
          'userid' => $request->lecturer_id,
          'courseid' => $request->course_id,
          'basic' => $data['courseID']->level,
          'access_level1' => $request->lecturer_id,
          'access_level2' => $request->lecturer_id,
          'access_level3' => $request->lecturer_id,
          
          ],
          [
            'coordinator' =>0
          ]
        );
      }
      return view('admin.courses.assign_subjects_to_lecturers', $data);
    }

    public function deleteModuleLecturer(Request $request, $userID)
    {
      $myClassSubjects = Myclasssubject::ClassSubject($request->class_id, $request->semester);
      
      $data['myclassSubjects'] = $myClassSubjects;
      $data['class_id'] = $request->class_id;
      $data['semester'] = $request->semester;
      if(!empty($userID))
      {
        $delete = lecturerSubjects::where('userid', $userID)
        ->where('classid', $request->class_id)
        ->where('courseid', $request->course_id)
        ->where('semester', $request->semester)
        ->where('campus_id', $request->campus_id)->delete();
      }
      if($delete)
      {
       
  
      return view('admin.courses.assign_subjects_to_lecturers', $data)->with('status', 'Lecturer detached successfully');
      }
      else{
        return view('admin.courses.assign_subjects_to_lecturers', $data)->with('invalid', 'Module not deleted');
      }
    }

    public function searchStudents(Request $request)
    {
      // for search 
      $data['classes'] = Programclass::all();
      $groupedClasses = [];
      
      if ($data['classes']->isNotEmpty()) {
          foreach ($data['classes'] as $class) {
              $campusId = $class->campus_id;
              
              // Initialize the array for this campus_id if it doesn't exist
              if (!isset($groupedClasses[$campusId])) {
                  $groupedClasses[$campusId] = [];
              }
              
              // Add the class to the array for this campus_id
              $groupedClasses[$campusId][] = $class;
          }
      }
      
      // Now you can use $groupedClasses as needed
      // For example, to create a search list of campus IDs:
      $data['campusList'] = array_keys($groupedClasses);
  
      //return view('admin.registration.class_list', compact('classes', 'campusList'));
      //for search
       // classID => "1"
       // semester => "1"
       $classInstance = Programclass::findOrFail($request->classID);
       $classcode = $classInstance->classcode;
       $classcampus = $classInstance->campus_id;

       if($classcampus==1)
       {
          $campus = 'Lilongwe';
          $campus1 = 'LL';
       }
       elseif($classcampus==2)
       {
        $campus = 'Blantyre';
        $campus1 = 'BT';
       }
       elseif($classcampus==3)
       {
        $campus = 'Zomba';
        $campus1 = 'ZA';
       }
  if($classcode) 
  {
    $data['students'] = User::where('programclass', $classcode)
                    ->where('campus', $campus)
                    ->where('semester', $request->semester)->get();

        $singlestudent = $data['students']->first();          
        $data['count'] = $data['students']->count();
        $data['classcampus'] = $campus1;
        $data['classcode'] = $classcode;
        $data['semester'] = $request->semester;
        $data['academic_yr'] = $singlestudent->academicyear_id;
        
        if($data['students']->isNotEmpty())
        {
          $data['singleStudent'] = $data['students']->first();
 
          return view('admin.registration.class_list2', $data);
        }
        else
        {
          return redirect()->back()->with('invalid', 'Currently no students found');
        }

  }


 
  }

  public function ExamSearchStudents(Request $request)
  {
    $data['classes'] = Programclass::all();
    $groupedClasses = [];
    
    if ($data['classes']->isNotEmpty()) {
        foreach ($data['classes'] as $class) {
            $campusId = $class->campus_id;
            
            // Initialize the array for this campus_id if it doesn't exist
            if (!isset($groupedClasses[$campusId])) {
                $groupedClasses[$campusId] = [];
            }
            
            // Add the class to the array for this campus_id
            $groupedClasses[$campusId][] = $class;
        }
    }
    
    // Now you can use $groupedClasses as needed
    // For example, to create a search list of campus IDs:
    $data['campusList'] = array_keys($groupedClasses);

    //return view('admin.registration.class_list', compact('classes', 'campusList'));
    //for search
     // classID => "1"
     // semester => "1"
     $classInstance = Programclass::findOrFail($request->classID);
     $classcode = $classInstance->classcode;
     $classcampus = $classInstance->campus_id;

     if($classcampus==1)
     {
        $campus = 'Lilongwe';
        $campus1 = 'LL';
     }
     elseif($classcampus==2)
     {
      $campus = 'Blantyre';
      $campus1 = 'BT';
     }
     elseif($classcampus==3)
     {
      $campus = 'Zomba';
      $campus1 = 'ZA';
     }
if($classcode) 
{
  $data['students'] = User::where('programclass', $classcode)
                  ->where('campus', $campus)
                  ->where('semester', $request->semester)->get();

if($data['students']->isEmpty())
{
  return redirect()->route('student.exam.numbers')
  ->with('invalid', 'Currently no students found for:'.' ' .$classcode.' | '.$campus. ' '.'Semester:'.$request->semester );
}


  $singleStu = $data['students']->first();
      
      if($data['students']->isNotEmpty())
      {

        $singlestudent = $data['students']->first();          
        $data['count'] = $data['students']->count();
        $data['classcampus'] = $campus1;
        $data['campus'] = $campus;
        $data['classcode'] = $classcode;
        $data['semester'] = $request->semester;
        $data['academic_yr'] = $singlestudent->academicyear_id;
        $data['title'] = 'Class List for Exam Numbers';

       // return view('admin.registration.class_list_for_exam_numbers', $data);

        $already = savedExamNumbers::where('pcode', $classcode)
        ->where('campus', $campus)
        ->where('semester', $request->semester)
        ->where('acdyear', $singleStu->academicyear_id)
        ->get();

        $data['alreadySaved'] = $already;

        if($already->isNotEmpty())
        {
          
          $data['title']='Students exam numbers.';
          $data['singleStudent'] = $singleStu;
          return view('admin.examnumbers.saved_exam_numbers', $data);
          
          
          /// Exam numbers already saved no need to regenerate JUST VIEW REG NUMBERS
          //return view('admin.registration.class_list_for_exam_numbers', $data);
        }

        $generated = classExaMNumbers::where('pcode',$classcode)
        ->where('pcampus', $campus)
        ->where('semester', $request->semester)


          // ->where('academic_yr', $academic_yr) // no need content to be deleted at every end of semester and insered into
          // another table for references
        ->get(); // academic year.


        if($generated->isNotEmpty())
        {
          $examNumbers = classExaMNumbers::where('pcode',$classcode)
            ->where('pcampus', $campus)
            ->where('semester', $request->semester)
              // ->where('academic_yr', $academic_yr) // no need content to be deleted at every end of semester and insered into
              // another table for references
            ->get(); // academic year.

            $data['students'] = User::where('programclass', $classcode)
            ->where('campus', $campus)
            ->where('semester',$request->semester)->get();

            $data['singleStudent'] = $data['students']->first();

            if($examNumbers->isNotEmpty())
            {
                $data['title']='Class exam numbers';
                $data['pcode']=$classcode;
                $data['pcampus']=$campus;
                $data['semester']=$request->semester;
               // $data['count']=$count;
                $data['stuWithExamNumbers']=$examNumbers;
                
              

                return view('admin.registration.class_list_for_exam_numbers', $data);
            }
          /// regenerate numbers
          //return view('admin.registration.class_list_for_exam_numbers', $data);
        }
        else
        {
          return redirect()->route(
        'get.exam.numbers', ['pclass'=>$classcode, 'pcampus'=>$campus, 
        'semester'=>$request->semester,
        'count'=>$data['count']]
        ); // redirect to generate exam numbers
          
        }

      }
      else
      {
        return redirect()->back()->with('invalid', 'Currently no students found');
      }

}



  }

//   public function ExamSearchStudents2($pcode, $campus, $semester, $count, $saved)
//   {
 
// if($pcode) 
// {
//   $data['students'] = User::where('programclass', $pcode)
//                   ->where('campus', $campus)
//                   ->where('semester', $semester)->get();


//   $singleStu = $data['students']->first();

//       $singlestudent = $data['students']->first(); 

//       $data['count'] = $data['students']->count();
//       $data['classcampus'] = $campus;
//       $data['classcode'] = $pcode;
//       $data['semester'] = $semester;
//       $data['academic_yr'] = $singleStu->academicyear_id;
//       $data['title'] = 'Class List for Exam Numbers';
      
//       if($data['students']->isNotEmpty())
//       {

       

//         $notSaved = classExaMNumbers::where('pcode',$pcode)
//         ->where('pcampus', $campus)
//         ->where('semester', $semester)
//           // ->where('academic_yr', $academic_yr) // no need content to be deleted at every end of semester and insered into
//           // another table for references
//         ->get(); // academic year.

// //dd($pcode, $campus, $semester, $singleStu->academicyear_id);

//        $data['NotSavedNum'] = $notSaved;

//         $data['singleStudent'] = $data['students']->first();
//         //dd($data['students']);
//         return view('admin.registration.class_list_for_exam_numbers', $data);
//       }
//       else
//       {
//         return redirect()->back()->with('invalid', 'Currently no students found');
//       }

// }



//   }
}
