<?php

namespace App\Http\Controllers;

use App\Models\Academicyear;
use App\Models\Myclasssubject;
use App\Models\Programclass;
use App\Models\User;
use App\Models\Campus;
use App\Models\Course;
use App\Models\Program;
use App\Models\Department;
use App\Models\lecturerSubjects;
use App\Models\Studentsubject;
use Illuminate\Http\Request;
use App\Models\savedExamNumbers;
use App\Models\classExaMNumbers;
Use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Faculty;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

class studentRegistrationController extends Controller
{
  public function classList(){
    $classes = Programclass::all();
    $AuthUser = Auth::user()->role;
    if($AuthUser == 'HOD'){
      $hod = Department::where('user_id', auth()->id())->first();

      if ($hod) // hod
      {
          // Get all programs under the department
          $programs = Program::where('department_id', $hod->id)->get();
      
          // Get all classes related to those programs
          $hodClasses = Programclass::whereIn('program_id', $programs->pluck('id'))->get();
      }
           return view('admin.registration.class_list', compact('classes', 'hodClasses'));  

    }
    
    elseif ($AuthUser == 'Dean' || $AuthUser == 'Deputy Dean') // Dean
    {
        $facultyDean = Faculty::where('user_id', auth()->id())->orWhere('dd_id',auth()->id())->first();
    
        if ($facultyDean) {
            // Get all department IDs under this faculty
            $deanDepartmentIds = Department::where('faculty_id', $facultyDean->id)->pluck('id');
    
            // Get all program IDs under these departments
            $deanProgramIds = Program::whereIn('department_id', $deanDepartmentIds)->pluck('id');
    
            // Get all program classes under these programs
            $deanClasses = ProgramClass::whereIn('program_id', $deanProgramIds)->get();

        }
        return view('admin.registration.class_list', compact('classes', 'deanClasses'));
    }

    elseif(Auth::user()->role=='Campus Registrar' || Auth::user()->role=='Principal') // Campus Registrar
    {
        $campus = Auth::user()->campus;
            if($campus == 'Lilongwe')
              {
                  $campus = '1';
              }
            if($campus == 'Blantyre')
              {
                  $campus = '2';
              }
            if($campus == 'Zomba')
              {
                  $campus = '3';
              }
        $cr = Programclass::where('campus_id', $campus)->get();
        return view('admin.registration.class_list', compact('classes', 'cr'));
        
    }
    elseif(Auth::user()->role=='DCR-Academic' ||
     Auth::user()->role=='DCR-Administration' ||
      Auth::user()->role=='College Registrar' ||
       Auth::user()->role=='Executive Director' || 
       Auth::user()->role=='Admin' ||
       Auth::user()->role=='Accountant' ||
      Auth::user()->role=='Finance Manager' ||
       Auth::user()->role=='Assistant Accountant' || 
       Auth::user()->role=='Accounts Clerk' ||
        Auth::user()->role=='Administrator') // Lecturer
        {
          $co = Programclass::all();
          return view('admin.registration.class_list', compact('classes', 'co'));
        }
          
    elseif(Auth::user()->role=='Lecturer'){ // Lecturer
    // Get unique class IDs, semester, and campus_id for the authenticated lecturer
    $lecturerClasses = lecturerSubjects::where('userid', auth()->id())
    ->select('classid', 'semester', 'campus_id')
    ->groupBy('classid', 'semester', 'campus_id')
    ->get();

        $classDetails = []; // Array to store class details

        if ($lecturerClasses->isNotEmpty()) {
            foreach ($lecturerClasses as $class) {
                $classDetails[] = Programclass::find($class->classid); // Collect each class
            }
        }
        
        return view('admin.registration.class_list', compact('classes', 'classDetails'));
      } 
      else{
        $underBasicLL = Programclass::where('under_basic', 1)->where('campus_id', 1)->get();
        $underBasicBT = Programclass::where('under_basic', 1)->where('campus_id', 2)->get();
        return view('admin.registration.class_list', compact('underBasicLL', 'underBasicBT'));
      }
        
   
}

  public function examClassList()
  {

    if(Auth::user()->role=='Campus Registrar') // Campus Registrar
    {
        $campus = Auth::user()->campus;
            if($campus == 'Lilongwe')
              {
                  $campus = '1';
              }
            if($campus == 'Blantyre')
              {
                  $campus = '2';
              }
            if($campus == 'Zomba')
              {
                  $campus = '3';
              }
        $cr = Programclass::where('campus_id', $campus)->get();
        return view('admin.registration.exam_class_list', compact('cr'));  
        
    }
    elseif(Auth::user()->role=='Admin' || Auth::user()->role=='Administrator'||
            Auth::user()->role=='Accountant' ||
            Auth::user()->role=='Finance Manager' ||
            Auth::user()->role=='Assistant Accountant' || 
            Auth::user()->role=='Accounts Clerk') // Lecturer
        {
          $admin = Programclass::all();
          return view('admin.registration.exam_class_list', compact('admin')); 
        }

    else{
      return view('admin.registration.exam_class_list'); 
    }
          
   
        
       
    // $groupedClasses = [];
    
    // if ($classes->isNotEmpty()) {
    //     foreach ($classes as $class) {
    //         $campusId = $class->campus_id;
            
    //         // Initialize the array for this campus_id if it doesn't exist
    //         if (!isset($groupedClasses[$campusId])) {
    //             $groupedClasses[$campusId] = [];
    //         }
            
    //         // Add the class to the array for this campus_id
    //         $groupedClasses[$campusId][] = $class;
    //     }
    // }
    
    // // Now you can use $groupedClasses as needed
    // // For example, to create a search list of campus IDs:
    // $campusList = array_keys($groupedClasses);

   
  }

  public function moduleRegister(){
    return view('admin.registration.module_register');
  }

  public function studentsConfirmation(){
    return view('admin.registration.students_confirmation');
  }

  public function modulesToStudents2()
  {
    if(!empty(Session::get('class_id')))
    {   
      //session()->has('class_id');
      $data = [
        'class' => Session::get('class_id'),
        'semester' => Session::get('semester'),
      ];

      $data['ourclass'] = Programclass::find($data['class']);
      $data['class_program'] = $data['ourclass']->program_id;
      $data['class_code'] = $data['ourclass']->classcode;
      
      return view('admin.intake.attach_subjects_to_students', $data)
      ->with('status','Course for:'.' '.$data['ourclass']->classcode.' '.'deleted successfully');
    }
  }

  public function modulesToStudents(Request $request)
  {
     
      
    $request->validate([
      'class' => 'required',
      'semester' => 'required'
    ]);

    $data['class'] = $request->class;
    $data['semester'] = $request->semester;
    $data['ourclass'] = Programclass::find($request->class);
    $data['class_program'] = $data['ourclass']->program_id;
    $data['class_code'] = $data['ourclass']->classcode;
    
    return view('admin.intake.attach_subjects_to_students', $data); 

  }

// OLD STARTING

//   public function allocateSubjectToStudents($class, $semester, $campus)
//   {
//     $stuCampus=$campus;
//     $myCampus = $campus;
//    // $classCampus = Campus::find($campus);
//     $classID = Programclass::where('id', $class)->first();
//    // dd($class, $semester, $campus, $ay);
//     $classSubjects = Myclasssubject::where('programclass_id', $class)
//     ->where('semester', $semester)
//     ->whereNull('academicyear_id')
//     ->where('classcode', $classID->classcode)
//     ->get();

//     //dd($classSubjects);

//     //$singleSubject = $classSubjects->first();
   
    
//     $campus = Campus::where('id', $campus)->first();
//     $classCode = $classID->classcode;
//     $campus = $campus->campus;
    
//     $classStudents = User::where('programclass', $classCode)
//     ->where('semester', $semester)
//     ->where('campus', $campus)
//     ->get();
//     //dd($class, $semester, $ay);
//     $singleStudent = $classStudents->first();
//     if(($singleStudent))
//     {
 

//     if(!empty($classSubjects) && !empty($classStudents)){
//       // creating pivot table for Students and Subjects
//     foreach ($classStudents as $classStudent) {
//       // Attaching Subjects by id
//           $classStudent->myclasssubject()->sync($classSubjects->pluck('id'));
//       // Save the student object after attaching all subjects
//       $classStudent->save();
//   }
  
//   // Save students subjects to another table.
 
//   foreach ($classStudents as $classStudent) {
//     foreach ($classSubjects as $subject) {
//         $subStudent = Studentsubject::firstOrCreate(
//             [
//                 'academicyr_id' => $classStudent->academicyear_id,
//                 'programclass_id' => $class,
//                 'semester' => $semester,
//                 'campus_id' => $stuCampus,
//                 'registration_no' => $classStudent->reg_num,
//                 'course_code' => $subject->course->code,
//             ],
//             [
//                 'assessment1' => 0,
//                 'assessment2' => 0,
//                 'exam_grade' => 0,
//                 'final_grade' => 0,
//             ]
//         );
//     }
// }

  
//   }
   
//   return redirect(route('add.subject.to.students'))->with([
//     'status' => 'Subjects assigned to Students under: ' . $classCode . ' | ' . $campus . '-Campus Semester: ' . $semester,
//     'class_id' => $class,
//     'campus' => $myCampus,
//     'semester' => $semester
//         ]);
    
//         }

//         else{
//           return redirect(route('add.subject.to.students'))->with([
//            'invalid' => 'No Students found in this class and campus',
//             'class_id' => $class,
//             'campus' => $myCampus,
//            'semester' => $semester
//             ]);
//         }
//   } OLD ENDING....

// NEW

  //MODIFIED VERSION OF THE A BOVE CODE...

  public function allocateSubjectToStudentsS($class, $semester, $campus)
{
    // Retrieve class information
    $classID = Programclass::find($class);
    if (!$classID) {
        return redirect()->back()->with('error', 'Class not found.');
    }

    // Retrieve subjects for the class and semester without an academic year
    $classSubjects = Myclasssubject::where('programclass_id', $class)
        ->where('semester', $semester)
        ->whereNull('academicyear_id')
        ->where('classcode', $classID->classcode)
        ->get(); /// cmpus will be found in class_id

    // Retrieve campus information
    $campus = Campus::find($campus);
    if (!$campus) {
        return redirect()->back()->with('invalid', 'Campus not found.');
    }

    // Retrieve students in the class, semester, and campus
    $classStudents = User::where('programclass', $classID->classcode)
        ->where('semester', $semester)
        ->where('campus', $campus->campus)
        ->get();

    if ($classStudents->isEmpty()) {
        return redirect(route('add.subject.to.students'))->with([
            'invalid' => 'No Students found in this class and campus',
            'class_id' => $class,
            'campus' => $campus->id,
            'semester' => $semester,
        ]);
    }

    // Handle subject removal and syncing
    foreach ($classStudents as $classStudent) {
        // 1. Get the old subjects that are currently attached to the student
        // $oldSubjectIds = $classStudent->myclasssubject()->pluck('id')->toArray();
        $oldSubjectIds = $classStudent->myclasssubject()->pluck('myclasssubjects.id')->toArray();

        // 2. Sync new subjects (this will remove old subjects from the pivot table and replace them with new ones)
        $classStudent->myclasssubject()->sync($classSubjects->pluck('id'));

                  // if ($classSubjects->isEmpty())
                  // {
                  //     // If there are no subjects, detach all subjects from the student
                  //     $classStudent->myclasssubject()->detach();
                  // } else {
                  //     // Sync new subjects (this will remove old subjects and replace with new ones)
                  //     $classStudent->myclasssubject()->sync($classSubjects->pluck('id'));
                  // }

        // 3. Identify the subjects that were removed
        $removedSubjectIds = array_diff($oldSubjectIds, $classSubjects->pluck('id')->toArray());

        // if (!empty($removedSubjectIds)) {
        //     // 4. Remove corresponding entries from Studentsubject table for the removed subjects
        //     Studentsubject::where('registration_no', $classStudent->reg_num)
        //         ->where('semester', $semester)
        //         ->where('programclass_id', $class)
        //         ->where('academicyr_id', $classStudent->academicyear_id)
        //         ->whereIn('course_code', function($query) use ($removedSubjectIds) {
        //             $query->select('course_code')
        //                   ->from('myclasssubjects')
        //                   ->whereIn('id', $removedSubjectIds);
        //         })
        //         ->delete();
        // }
        if (!empty($removedSubjectIds)) {
          $removedCourses = Myclasssubject::whereIn('id', $removedSubjectIds)->pluck('course_code');
      
          Studentsubject::where('registration_no', $classStudent->reg_num)
              ->where('semester', $semester)
              ->where('programclass_id', $class)
              ->where('academicyr_id', $classStudent->academicyear_id)
              ->whereIn('course_code', $removedCourses)
              ->delete();
      
          Log::info("Deleted subjects", [
              'student' => $classStudent->reg_num,
              'removed_courses' => $removedCourses->toArray()
          ]);
      }

        // 5. Insert or update records in Studentsubject table for the new subjects
        foreach ($classSubjects as $subject) {
            Studentsubject::firstOrCreate(
                [
                    'academicyr_id' => $classStudent->academicyear_id,
                    'programclass_id' => $class,
                    'semester' => $semester,
                    'campus_id' => $campus->id,
                    'registration_no' => $classStudent->reg_num,
                    'course_code' => $subject->course->code,
                    'user_id' => $classStudent->id,
                ],
                [
                    'assessment1' => null,
                    'assessment2' => null,
                    'exam_grade' => null,
                    'final_grade' => null,
                ]
            );
        }
    }

    // Redirect with success message
    return redirect(route('add.subject.to.students'))->with([
        'status' => 'Subjects assigned to Students under: ' . $classID->classcode . ' | ' . $campus->campus . '-Campus Semester: ' . $semester,
        'class_id' => $class,
        'campus' => $campus->id,
        'semester' => $semester
    ]);
}
 
/// END OF MODIFIED VERSION......


 
/// END OF MODIFIED VERSION......



  public function ModulesToLecturers(Request $request)
  {
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
          'access_level4' => $request->lecturer_id,
          
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
      //dd($userID,$request->class_id,$request->semester);
      $myClassSubjects = Myclasssubject::ClassSubject($request->class_id, $request->semester);
      
      $data['myclassSubjects'] = $myClassSubjects;
      $data['class_id'] = $request->class_id;
      $data['semester'] = $request->semester;

      //dd($userID,$request->class_id,$request->course_id, $request->semester,$request->campus_id);
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
                    ->where('semester', $request->semester)->orderBy('lname', 'asc')->get();

        $singlestudent = $data['students']->first(); 
        if(!empty($singlestudent->academicyear_id)) 
        {
          $data['count'] = $data['students']->count();
          $data['classcampus'] = $campus1;
          $data['classcode'] = $classcode;
          $data['semester'] = $request->semester;
          $data['classID'] = $request->classID;
          $data['academic_yr'] = $singlestudent->academicyear_id;
        }        
       
        
        if($data['students']->isNotEmpty())
        {
          $data['singleStudent'] = $data['students']->first();
 
          return view('admin.registration.class_list2', $data);
        }
        else
        {
          return redirect()->back()->with('invalid', 'Currently no students found for class:' .$classcode.' -Semester '.$request->semester.' | '.$campus1);
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
                  ->where('semester', $request->semester)
                  ->orderBy('lname', 'asc') // Order by first name in ascending order
                  ->get();

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



  }  // End function

  public function resetStudentPassword($studentID)
  {
    $studentReset = User::findOrfail($studentID);
    if($studentReset)
    {
        return view('admin.users.reset_student_password', compact('studentReset'));
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
public function getClassListPDF($classID, $semester)
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

       $classInstance = Programclass::findOrFail($classID);

       $classcode = $classInstance->classcode;
       $classcampus = $classInstance->campus_id;

       if($classcampus==1)
       {
          $campus = 'Lilongwe';
       }
       elseif($classcampus==2)
       {
        $campus = 'Blantyre';
       }
       elseif($classcampus==3)
       {
        $campus = 'Zomba';
       }
  if($classcode) 
  {

         $data['students'] = User::where('programclass', $classcode)
                    ->where('campus', $campus)
                    ->where('semester', $semester)
                    ->orderBy('lname', 'asc') // Order by first name in ascending order
                    ->get();

        $singlestudent = $data['students']->first(); 
        if(!empty($singlestudent->academicyear_id)) 
        {
          $data['count'] = $data['students']->count();
          $data['classcampus'] = $campus;
          $data['classcode'] = $classcode;
          $data['semester'] = $semester;
          $data['academic_yr'] = $singlestudent->academicyear_id;
          $data['myclass'] = $classInstance;
        }        
       
        
        if($data['students']->isNotEmpty())
        {
        $data['singleStudent'] = $data['students']->first();
          /// SEND TO PDF 
          $pdf = Pdf::loadView('admin.pdf.classlist_pdf', $data)->setPaper('A4', 'portrait');
        return $pdf->download($data['myclass']->classcode.'_'.$campus.'_Semester'.$data['semester'].'_Class_list.pdf');
        
        }
        
  }
}

    public function studentsSignOff()
    {
      return view('admin.student.signoff');
    }

    public function studentsSemesterIncrements()
    {
      return view('admin.student.semester_increment');
    }

    public function signingOffStudents(Request $request)
    {
      $class = $request->class;
      $semester = $request->semester;

      $pclass = Programclass::findOrFail($class);
      return view('admin.student.move_students', compact('pclass','semester'));

    }

    public function signOffSemesterIncrements(Request $request)
    {
      $data['myclass'] = $request->class;
      $data['class_id'] =  $request->class;
      $data['semester'] = $request->semester;
      $data['ay'] = $request->ay;

      $data['acy'] = Academicyear::findOrFail($data['ay']);
      $data['pclass'] = Programclass::findOrFail($data['myclass']);

      
      $data['class'] = Programclass::all();
      $data['campus'] = Campus::all();
      $data['classStudents'] = User::where('programclass', $data['pclass']->classcode)
      ->where('semester', $data['semester'])->where('campus_id', $data['pclass']->campus_id)->get();
      
      $data['firststudent'] = $data['classStudents']->first();
      if($data['classStudents']->count() > 0 && ($data['ay'] == $data['firststudent']->academicyear_id))
      {
        
        return view('admin.student.incremented_semester_students', $data);
      }

      return redirect()->back()->with('invalid', 'Program class, '.$data['pclass']->classcode.' Sem: '.$data['semester'].' | '.$data['acy']->ayear.' '.$data['acy']->month.'|'.$data['acy']->description.' currently has no students.' );

    }

    public function updateCumulativeSemester(Request $request)
    {
      $classcode = $request->classcode;
      $acy = $request->acy;
      $semester = $request->semester;
      $campus = $request->campus;

      if($campus==1){$mycampus='Lilongwe';}
      if($campus==2){$mycampus='Blantyre';}
      if($campus==3){$mycampus='Zomba';}

      $stu = User::where('programclass', $classcode)
           ->where('academicyear_id', $acy)
           ->where('semester', $semester)
           ->where('campus', $mycampus)
           ->get();  // Get the result of the query

      if($stu->isNotEmpty())
      {
        foreach($stu as $student)
        {
          $updated = $student->update([

            'cum_semester'=> $request->cum_semester

          ]);
        }

        if($updated)
        {
          return redirect()->route('students.semester.increments')
          ->with('status', 'Semester acumulation for class: '.$classcode .'| Sem:' .$semester. ' updated to: Cumulative Semester (' .$request->cum_semester. ' ) ');
        }
      }
     
    }

    public function updateSigningOffStudents(Request $request)
    {
          
      $class = $request->class_id;
      $semester = $request->semester;

      $pclass = Programclass::findOrFail($class);
      
      if(empty($request->new_semester))
           {
            return view('admin.student.move_students', compact('pclass','semester'))
            ->with('status', 'Please provide the semester needed for the signing off.');
           }

            $oldclass = $request->class_id;
            $oldsemester = $request->semester;
            $newclass = $request->new_class;
            $newsemester = $request->new_semester;
            $campusID = $request->campus_id;

          $oldpclass = Programclass::findOrFail($oldclass);
          $changeclass = User::where('programclass', $oldpclass->classcode)->where('semester', $oldsemester)
          ->where('campus_id', $campusID)->get();

          $mynewClass = Programclass::findOrFail($newclass);
          
          if(($oldclass==$newclass) && ($oldsemester==$newsemester))
          {
            $class = $request->class_id;
            $semester = $request->semester;
      
            $pclass = Programclass::findOrFail($class);
            return view('admin.student.move_students', compact('pclass','semester'))
            ->with('status', 'Current class and semester same as your current choice of change. May be they have completed their studies.');
          }
          else{
            foreach($changeclass as $stuChange)
            {
              $stuChange->update([
                'programclass' => $mynewClass->classcode,
                'semester' => $newsemester
              ]);
            }
           
          }

          return redirect()->route('students.signoff')->with('status', 'Students for: '.$oldpclass->classcode. '|' .$oldsemester.' moved to: '.$mynewClass->classcode.' | '.$newsemester.' successfully.');
    }

}
