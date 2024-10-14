<?php
namespace App\Http\Controllers;
use App\Models\Studentsubject;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Department;
use App\Models\Programclass;
use App\Models\lecturerSubjects;
use App\Models\Myclasssubject;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Program;

class assessmentsController extends Controller
{
    public function listAssessments($id, $ay) // id of course in leturer_subjects table.
    {
        $data['title'] = 'list of Assessments';
        $data['id'] = $id;
        $data['ay'] = $ay;
      
        return view('admin.grades.assessment_list', $data);
    }

    public function studentsGradingAssessment1($id, $assessment, $ay) // id from lecturer_subjects
    {
        $data['title'] = 'Students grading';
        $data['id'] = $id; // lecturer subject id
        $data['ay'] = $ay;
        $data['assessment'] = $assessment;

        $data['lectSub'] = lecturerSubjects::find($id); //id in the lecturer table ie 12, not courseid.
        $access_level1 = $data['lectSub']->access_level1;
        $access_level2 = $data['lectSub']->access_level2;
        $access_level3 = $data['lectSub']->access_level3;
        $access_level4 = $data['lectSub']->access_level4;
        $a_level = $data['lectSub']->access_level1;
      

       // dd($lectSub);
        // $coursename = Course::find($course->courseid);
        $data['courseID'] = Course::find($data['lectSub']->courseid); //21
       

        $data['mycoursename'] = Programclass::where('id', $data['lectSub']->classid)->first();
       // dd($data['mycoursename']); // class = DCA1

       
        $data['stu'] = Studentsubject::where('programclass_id', $data['lectSub']->classid)
                ->where('semester', $data['lectSub']->semester)
                ->where('campus_id', $data['lectSub']->campus_id)
                ->where('academicyr_id', $ay)
                ->where('course_code', $data['courseID']->code)
                ->get(); // developed@AndyChigalu

        // retrieve data from db if table has grades.
        $mylecturerID = Auth()->user()->id;

        if($assessment==1)
        {
            if($access_level1 == $mylecturerID)// dont change here
            {
             return view('admin.grades.student_grading', $data);
            }
            elseif($access_level1 != $mylecturerID)
            {
             return view('admin.grades.student_graded', $data);
            }
        }
        elseif($assessment==2)
        {
            if($access_level2 == $mylecturerID)// dont change here
            {
             return view('admin.grades.student_grading', $data);
            }
            elseif($access_level2 != $mylecturerID)
            {
             return view('admin.grades.student_graded', $data);
            }
        }

        elseif($assessment==3)
        {
            if($access_level3 == $mylecturerID)// dont change here
            {
             return view('admin.grades.student_grading', $data);
            }
            elseif($access_level3 != $mylecturerID)
            {
             return view('admin.grades.student_graded', $data);
            }
        }

        elseif($assessment==4)
        {
            if($access_level4 == $mylecturerID)// dont change here
            {
             return view('admin.grades.student_grading', $data);
            }
            elseif($access_level4 != $mylecturerID)
            {
             return view('admin.grades.student_graded', $data);
            }
        }

        

      

        
    }

    public function studentsGraded1(Request $request, $id, $assessment) //textboxes not disabled // not submitted to HOD
    {
        //dd($request->all());
        $data['id'] = $id;
       // dd($id);
        $data['lectSub'] = lecturerSubjects::find($id); //id in the lecturer table, courseid = 21
        $mycourseID = $data['lectSub']->courseid;
        $data['courseID'] = Course::find($mycourseID); //21
       // dd($data['courseID']->code);

        $data['assessment'] = $assessment;
        $data['title'] = 'Students Grading';

        if (!empty($request->registration)) {
            
            if ($request->assessment_id == '1') {
                foreach ($request->registration as $key => $registration) {
                    $student = Studentsubject::where('registration_no', $registration)->where('course_code', $data['courseID']->code)->first();
                    
                   // dd($registration);
                    if (!empty($student)) {
                        $student->assessment1 = $request->assessment[$key] ?? null;
                        $student->save();
                       
                    }
                }

               
                return redirect(route('students.grading', ['id' => $id, 'assessment' => $assessment, 'ay'=>$request->ay]))
                ->with('status', 'Students assessment 1 graded successfully');
                //return view('admin.grades.student_grading', $data)->with('status', 'Students graded successfully!');

            } elseif ($request->assessment_id == '2') {
                foreach ($request->registration as $key => $registration) {
                    $student = Studentsubject::where('registration_no', $registration)->where('course_code', $data['courseID']->code)->first();
                    if (!empty($student)) {
                        $student->assessment2 = $request->assessment[$key] ?? null;
                        $student->save();
                       
                    }
                }
                return redirect(route('students.grading', ['id' => $id, 'assessment' => $assessment, 'ay'=>$request->ay]))
                ->with('status', 'Students Mid-semester graded successfully');

            } elseif ($request->assessment_id == '3') {
                foreach ($request->registration as $key => $registration) {
                    $student = Studentsubject::where('registration_no', $registration)->where('course_code', $data['courseID']->code)->first();
                    if (!empty($student)) {
                        $student->exam_grade = $request->assessment[$key] ?? null;
                        $student->save();

                        // Now select from lecturer subjects and compute final grade..
                    }
                }
             
                return redirect(route('students.grading', ['id' => $id, 'assessment' => $assessment, 'ay'=>$request->ay]))
                ->with('status', 'Students End of Semester exam graded successfully');

            } elseif ($request->assessment_id == '4') {
                foreach ($request->registration as $key => $registration) {
                    $student = Studentsubject::where('registration_no', $registration)->where('course_code', $data['courseID']->code)->first();
                    if (!empty($student)) {
                        $student->final_grade = $request->assessment[$key] ?? null;
                        $student->save();

                        // Now select from lecturer subjects and compute final grade..
                    }
                }
             
                return redirect(route('students.grading', ['id' => $id, 'assessment' => $assessment, 'ay'=>$request->ay]))
                ->with('status', 'Students final grade graded successfully');

            } 

            
            else {
                return view('admin.grades.student_grading', $data)->with('invalid', 'Something went wrong');
            }
        }
    }

    public function studentsGradedSubmitedToHOD($id, $assessment) // when lecturer have submitted to HOD 
    {   
        $data['id'] = $id;
        $data['assessment'] = $assessment;
        $data['title'] = 'Students Graded';

        $data['lectSub'] = lecturerSubjects::find($id); //id = 34 courseid = 21

       // dd($lectSub);
       // $coursename = Course::find($course->courseid);
        $data['courseID'] = Course::find($data['lectSub']->courseid); //DCA1105

        $data['mycoursename'] = Programclass::where('id', $data['lectSub']->classid)->first();
       // dd($data['mycoursename']); // class = DCA1
        $data['stu'] = Studentsubject::where('programclass_id', $data['lectSub']->classid)
                ->where('semester', $data['lectSub']->semester)
                ->where('campus_id', $data['lectSub']->campus_id)
                ->where('course_code', $data['courseID']->code)->get(); 
        return view('admin.grades.student_grading', $data)->with('status', 'Assessment graded successfully!');
    }


    public function submitHodAssessment1($id, $assessment, $ay) // for assessment 1
    {
        $submitted = lecturerSubjects::find($id); // id of a subject in LecturerSubjects table
       // $submitted->classid;
       $lecturerSubjBasic = $submitted->basic; // 1 basic, 2 (post basic) or (not under basic HOD)[taken from courses Basic or Post Basic]
        
       // dd($pclass->classcode, $pclass->classname, $pclass->under_basic);

     if($assessment==1) // assignment 1
        {
                            if($lecturerSubjBasic==1) // basic
                            {
                                $pclass = Programclass::where('id',$submitted->classid)->where('campus_id', $submitted->campus_id)->first();
                                $classCoordinator = $pclass->coordinator;
                                $campus = $pclass->campus_id;
                                if($campus==1) // basic Lilongwe
                                {
                                    
                                    $hodID = User::where('role','HOD-BASIC-LL')->get();

                                    $newhodID = $hodID->first();
                                    $newhodID = $newhodID->id;
                                    $submitted->update([

                                        'access_level1' => $newhodID,
                                    ]);
                                    
                                    return redirect(route('students.grading', ['id' => $id, 'assessment' => $assessment, 'ay'=>$ay]))->with('status', 'Course assessment submitted to HOD Basic Lilongwe.');
                                    
                                    
                                };
                                if($campus==2) // basic Blantyre
                                {
                                    $hodID = User::where('role','HOD-BASIC-BT')->get();

                                    $newhodID = $hodID->first();
                                    $newhodID = $newhodID->id;
                                    $submitted->update([

                                        'access_level1' => $newhodID,
                                    ]);
                                    
                                    return redirect(route('students.grading', ['id' => $id, 'assessment' => $assessment, 'ay'=>$ay]))->with('status', 'Course assessment submitted to HOD Basic Blantyre.');
                                };
                                if($campus==3) // basic Zomba
                                {
                                    $hodID = User::where('role','HOD-BASIC-ZA')->get();

                                    $newhodID = $hodID->first();
                                    $newhodID = $newhodID->id;
                                    $submitted->update([

                                        'access_level1' => $newhodID,
                                    ]);
                                    
                                    return redirect(route('students.grading', ['id' => $id, 'assessment' => $assessment, 'ay'=>$ay]))->with('status', 'Course assessment submitted to HOD Basic Zomba.');
                                };

                                //  return redirect()->back()->with('status', 'Assessment submitted to HOD basic - '.' ' .$mycampus.'.');
                                //dd($classCoordinator);
                                
                            } 
                            elseif($lecturerSubjBasic==2) // not part of combined basic
                            {
                                $pclass = Programclass::where('id', $submitted->classid)->where('campus_id', $submitted->campus_id)->first();
                                //dd($pclass->under_basic);
                                if($pclass->campus_id==1){$pcampus = 'Lilongwe';};
                                if($pclass->campus_id==2){$pcampus = 'Blantyre';};
                                if($pclass->campus_id==3){$pcampus = 'Zomba';};

                                $classProgramId = $pclass->program_id;
                                //dd($classCoordinator);

                                $programId = Program::find($classProgramId);
                                
                                $departmentID = Department::find($programId->department_id);

                                $departmentHOD = $departmentID->user_id;

                                //dd($departmentHOD);

                                if(!empty($pclass))
                                {   
                                    // if($pclass->classcode=='DCM1' || $pclass->classcode=='DCM1')
                                    // { COMPARE WITH CAMPUS AS WELL
                                        $submitted->update([

                                            'access_level1' => $departmentHOD,
                                        ]);
                                    // }
                                    
                                }
                                return redirect(route('students.grading', ['id' => $id, 'assessment' => $assessment, 'ay'=>$ay]))->with('status', 'Assessment submitted to Head, ' .$departmentID->department_name.' | '. $pcampus. '.');
                         }
            }// End of assessment 1

 elseif($assessment==2) // Start of Mid-semester examination
            {
                if($lecturerSubjBasic==1) // basic
                {
                    $pclass = Programclass::where('id',$submitted->classid)->where('campus_id', $submitted->campus_id)->first();
                    $classCoordinator = $pclass->coordinator;
                    $campus = $pclass->campus_id;
                    if($campus==1) // basic Lilongwe
                    {
                        
                        $hodID = User::where('role','HOD-BASIC-LL')->get();

                        $newhodID = $hodID->first();
                        $newhodID = $newhodID->id;
                        $submitted->update([

                            'access_level2' => $newhodID,
                        ]);
                        
                        return redirect(route('students.grading', ['id' => $id, 'assessment' => $assessment, 'ay'=>$ay]))->with('status', 'Mid-semester submitted to HOD Basic Lilongwe.');
                        
                        
                    };
                    if($campus==2) // basic Blantyre
                    {
                        $hodID = User::where('role','HOD-BASIC-BT')->get();

                        $newhodID = $hodID->first();
                        $newhodID = $newhodID->id;
                        $submitted->update([

                            'access_level2' => $newhodID,
                        ]);
                        
                        return redirect(route('students.grading', ['id' => $id, 'assessment' => $assessment, 'ay'=>$ay]))->with('status', 'Mid-semester submitted to HOD Basic Blantyre.');
                    };
                    if($campus==3) // basic Zomba
                    {
                        $hodID = User::where('role','HOD-BASIC-ZA')->get();

                        $newhodID = $hodID->first();
                        $newhodID = $newhodID->id;
                        $submitted->update([

                            'access_level2' => $newhodID,
                        ]);
                        
                        return redirect(route('students.grading', ['id' => $id, 'assessment' => $assessment, 'ay'=>$ay]))->with('status', 'Mid-semester submitted to HOD Basic Zomba.');
                    };

                    //  return redirect()->back()->with('status', 'Assessment submitted to HOD basic - '.' ' .$mycampus.'.');
                    //dd($classCoordinator);
                    
                } 
                elseif($lecturerSubjBasic==2) // not part of combined basic
                {
                    $pclass = Programclass::where('id', $submitted->classid)->where('campus_id', $submitted->campus_id)->first();
                    //dd($pclass->under_basic);
                    if($pclass->campus_id==1){$campus = 'Lilongwe';};
                    if($pclass->campus_id==2){$campus = 'Blantyre';};
                    if($pclass->campus_id==3){$campus = 'Zomba';};

                    $classProgramId = $pclass->program_id;
                    //dd($classCoordinator);

                    $programId = Program::find($classProgramId);
                    
                    $departmentID = Department::find($programId->department_id);

                    $departmentHOD = $departmentID->user_id;

                    //dd($departmentHOD);

                    if(!empty($pclass))
                    {   
                        // if($pclass->classcode=='DCM1' || $pclass->classcode=='DCM1')
                        // { COMPARE WITH CAMPUS AS WELL
                            $submitted->update([

                                'access_level2' => $departmentHOD,
                            ]);
                        // }
                        
                    }
                    return redirect(route('students.grading', ['id' => $id, 'assessment' => $assessment, 'ay'=>$ay]))->with('status', 'Mid-semester submitted to Head, ' .$departmentID->department_name.' | '. $campus. '.');
             }
            } // End of Mid-semester examination

elseif($assessment==3) // Start of End-of-semester-exam
            {
                if($lecturerSubjBasic==1) // basic
                {
                    $pclass = Programclass::where('id',$submitted->classid)->where('campus_id', $submitted->campus_id)->first();
                    $classCoordinator = $pclass->coordinator;
                    $campus = $pclass->campus_id;
                    if($campus==1) // basic Lilongwe
                    {
                        
                        $hodID = User::where('role','HOD-BASIC-LL')->get();

                        $newhodID = $hodID->first();
                        $newhodID = $newhodID->id;
                        $submitted->update([

                            'access_level3' => $newhodID,
                        ]);
                        
                        return redirect(route('students.grading', ['id' => $id, 'assessment' => $assessment, 'ay'=>$ay]))->with('status', 'End of semester results submitted to HOD Basic Lilongwe.');
                        
                        
                    };
                    if($campus==2) // basic Blantyre
                    {
                        $hodID = User::where('role','HOD-BASIC-BT')->get();

                        $newhodID = $hodID->first();
                        $newhodID = $newhodID->id;
                        $submitted->update([

                            'access_level3' => $newhodID,
                        ]);
                        
                        return redirect(route('students.grading', ['id' => $id, 'assessment' => $assessment, 'ay'=>$ay]))->with('status', 'End of semester results submitted to HOD Basic Blantyre.');
                    };
                    if($campus==3) // basic Zomba
                    {
                        $hodID = User::where('role','HOD-BASIC-ZA')->get();

                        $newhodID = $hodID->first();
                        $newhodID = $newhodID->id;
                        $submitted->update([

                            'access_level3' => $newhodID,
                        ]);
                        
                        return redirect(route('students.grading', ['id' => $id, 'assessment' => $assessment, 'ay'=>$ay]))->with('status', 'End of semester results submitted to HOD Basic Zomba.');
                    };

                    //  return redirect()->back()->with('status', 'Assessment submitted to HOD basic - '.' ' .$mycampus.'.');
                    //dd($classCoordinator);
                    
                } 
                elseif($lecturerSubjBasic==2) // not part of combined basic
                {
                    $pclass = Programclass::where('id', $submitted->classid)->where('campus_id', $submitted->campus_id)->first();
                    //dd($pclass->under_basic);
                    if($pclass->campus_id==1){$campus = 'Lilongwe';};
                    if($pclass->campus_id==2){$campus = 'Blantyre';};
                    if($pclass->campus_id==3){$campus = 'Zomba';};

                    $classProgramId = $pclass->program_id;
                    //dd($classCoordinator);

                    $programId = Program::find($classProgramId);
                    
                    $departmentID = Department::find($programId->department_id);

                    $departmentHOD = $departmentID->user_id;

                    //dd($departmentHOD);

                    if(!empty($pclass))
                    {   
                        // if($pclass->classcode=='DCM1' || $pclass->classcode=='DCM1')
                        // { COMPARE WITH CAMPUS AS WELL
                            $submitted->update([

                                'access_level3' => $departmentHOD,
                            ]);
                        // }
                        
                    }
                    return redirect(route('students.grading', ['id' => $id, 'assessment' => $assessment, 'ay'=>$ay]))->with('status', 'End of semester results submitted to Head, ' .$departmentID->department_name.' | '. $campus. '.');
             }

            } // End of End-of-semester-exam

elseif($assessment==4) // Start of End-of-semester-exam
            {
                return redirect(route('students.grading', ['id' => $id, 'assessment' => $assessment, 'ay'=>$ay]))->with('invalid', 'Take note, Final grade will be computed by the system itself, upon discussions
                with HODs, Deans, Lecturers and the Administration, for now its computed by the Lecturer.'); 
            }

else
            {
                return redirect()->back()->with('status', 'Invalid Assessment');
            }
       

       // return back();
    }

    public function submitGradesToStudents($id, $assessment, $ay) // id from lecturer_sub table.
    {
        // Retrieve the course information
        $subjfromlecturerTable = lecturerSubjects::findOrfail($id);
        $mysubject = $subjfromlecturerTable->courseid;
        $subjcode = Course::findOrfail($mysubject);
        $mysubjcode = $subjcode->code;
    
        // Retrieve the student access for the specific course and academic year
        $studentaccess = Studentsubject::where('academicyr_id', $ay)
            ->where('programclass_id', $subjfromlecturerTable->classid)
            ->where('course_code', $mysubjcode)
            ->where('semester', $subjfromlecturerTable->semester)
            ->where('campus_id', $subjfromlecturerTable->campus_id)
            ->get();
    
        // Check if student access records exist
        if ($studentaccess->isNotEmpty()) {
            foreach ($studentaccess as $stu) {
                switch ($assessment) {
                    case 1:
                        $stu->update(['access_assessment1' => 1]);
                        break;
                    case 2:
                        $stu->update(['access_assessment2' => 1]);
                        break;
                    case 3:
                        $stu->update(['access_exam_grade' => 1]);
                        break;
                    case 4:
                        $stu->update(['access_final_grade' => 1]);
                        break;
                    default:
                        // Optional: Log or handle invalid assessment values
                        // Example: Log::error("Invalid assessment value: $assessment");
                        break;
                }
            }

            return redirect(route('students.grading', ['id' => $id, 'assessment' => $assessment, 'ay'=>$ay]))
            ->with('status', 'Results successfully published to students.');
        } else {
            // Optional: Handle or log if no students match the criteria
            // Example: Log::warning("No students found for course code: $mysubjcode, academic year: $ay");
            return redirect(route('students.grading', ['id' => $id, 'assessment' => $assessment, 'ay'=>$ay]))
            ->with('invalid', 'No students found');
        }
    }

    public function unpublishGradesToStudents($id, $assessment, $ay) // id from lecturer_sub table.
    {
        // Retrieve the course information
        $subjfromlecturerTable = lecturerSubjects::findOrfail($id);
        $mysubject = $subjfromlecturerTable->courseid;
        $subjcode = Course::findOrfail($mysubject);
        $mysubjcode = $subjcode->code;
    
        // Retrieve the student access for the specific course and academic year
        $studentaccess = Studentsubject::where('academicyr_id', $ay)
            ->where('programclass_id', $subjfromlecturerTable->classid)
            ->where('course_code', $mysubjcode)
            ->where('semester', $subjfromlecturerTable->semester)
            ->where('campus_id', $subjfromlecturerTable->campus_id)
            ->get();
    
        // Check if student access records exist
        if ($studentaccess->isNotEmpty()) {
            foreach ($studentaccess as $stu) {
                switch ($assessment) {
                    case 1:
                        $stu->update(['access_assessment1' => 0]);
                        break;
                    case 2:
                        $stu->update(['access_assessment2' => 0]);
                        break;
                    case 3:
                        $stu->update(['access_exam_grade' => 0]);
                        break;
                    case 4:
                        $stu->update(['access_final_grade' => 0]);
                        break;
                    default:
                        // Optional: Log or handle invalid assessment values
                        // Example: Log::error("Invalid assessment value: $assessment");
                        break;
                }
            }

            return redirect(route('students.grading', ['id' => $id, 'assessment' => $assessment, 'ay'=>$ay]))
            ->with('status', 'Results successfully removed from students.');
        } else {
            // Optional: Handle or log if no students match the criteria
            // Example: Log::warning("No students found for course code: $mysubjcode, academic year: $ay");
            return redirect(route('students.grading', ['id' => $id, 'assessment' => $assessment, 'ay'=>$ay]))
            ->with('invalid', 'No students found');
        }
    }
    
}
