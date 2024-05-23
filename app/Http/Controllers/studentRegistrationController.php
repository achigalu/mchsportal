<?php

namespace App\Http\Controllers;

use App\Models\Myclasssubject;
use App\Models\Programclass;
use App\Models\User;
use App\Models\Campus;
use App\Models\Studentsubject;
use Illuminate\Http\Request;

class studentRegistrationController extends Controller
{
  public function classList(){
    return view('admin.registration.class_list');
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
    $data['class'] = $request->class;
    $data['semester'] = $request->semester;
    
    return view('admin.intake.attach_subjects_to_students', $data);

  }
  public function allocateSubjectToStudents($class, $semester, $campus)
  {
    $stuCampus=$campus;
    $myCampus = $campus;

    $classSubjects = Myclasssubject::where('programclass_id', $class)->where('semester', $semester)->where('campus_id', $campus)->get();
    $singleSubject = $classSubjects->first();
   
    $classID = Programclass::where('id', $class)->first();
    $campus = Campus::where('id', $campus)->first();
    $classCode = $classID->classcode;
    $campus = $campus->campus;
    
    $classStudents = User::where('programclass', $classCode)->where('semester', $semester)->where('campus', $campus)->get();
    $singleStudent = $classStudents->first();
    if(($singleStudent))
    {
    
   
    if($singleStudent->campus == 'Lilongwe')
    {
        $Scampus = 1;
    }
    if($singleStudent->campus == 'Blantyre')
    {
        $Scampus = 2;
    }
    if($singleStudent->campus == 'Zomba')
    {
        $Scampus = 3;
    }

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
           'status' => 'No Students found in this class and campus',
            'class_id' => $class,
            'campus' => $myCampus,
           'semester' => $semester
            ]);
        }
  }

  public function ModulesToLecturers(Request $request)
  {
    //dd($request->all());
    if(!empty($request->class_id) && !empty($request->semester))
    {
      
      $class = Myclasssubject::where('programclass_id', $request->class_id)->where('semester', $request->semester)->first();
     if(!empty($class))
     {
      
     if(!empty($class))
     {  
               $myCampus = Campus::find($class->campus_id)->campus;
              $user = User::where('programclass', $class->classcode)
              ->where('semester', $request->semester)
              ->where('campus', $myCampus)->first();

              if(!empty($user))
                      {
                        $result = Studentsubject::where('registration_no', $user->reg_num)
                      ->where('semester', $user->semester)
                      ->where('campus_id', $class->campus_id)->get();
                      
                      
                            if(!empty($result))
                            {
                            
                              return redirect()->route('subjects.to.lecturers')->with('result', $result);
                              
                            }
                            else
                            {
                              return redirect()->back()->with('invalid', 'No subjects found yet');
                            }
                      }
                      else{
                          return redirect()->back()->with('invalid', 'No students found in this class and campus');
                      }

                
      
     }
     else
     {
       return redirect()->back()->with('invalid', 'No subjects found in this class and semester');
     }
     }else{

      return redirect(route('subjects.to.lecturers'))->with(
        'invalid', 'This class is not completely defined, like no students or subjects added'
         );
     }

    }else
    {
      return redirect()->back()->with('invalid', 'Please choose options first');
    }

  }

}
