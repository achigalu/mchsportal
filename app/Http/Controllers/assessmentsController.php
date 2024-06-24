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
    public function listAssessments($id)
    {
        $data['title'] = 'list of Assessments';
        $data['id'] = $id;
        return view('admin.grades.assessment_list', $data);
    }

    public function studentsGrading($id, $assessment)
    {
        $data['title'] = 'Students grading';
        $data['id'] = $id;
        $data['assessment'] = $assessment;

        $data['lectSub'] = lecturerSubjects::find($id); //id in the lecturer table = 34 courseid = 21
        $access_level = $data['lectSub']->access_level;
        $a_level = $data['lectSub']->access_level;
      

       // dd($lectSub);
        // $coursename = Course::find($course->courseid);
        $data['courseID'] = Course::find($data['lectSub']->courseid); //DCA1105
       

        $data['mycoursename'] = Programclass::where('id', $data['lectSub']->classid)->first();
       // dd($data['mycoursename']); // class = DCA1

       
        $data['stu'] = Studentsubject::where('programclass_id', $data['lectSub']->classid)
                ->where('semester', $data['lectSub']->semester)
                ->where('campus_id', $data['lectSub']->campus_id)
                ->where('course_code', $data['courseID']->code)
                ->get(); 

        // retrieve data from db if table has grades.
       if($access_level==1)// dont change here
       {
        return view('admin.grades.student_grading', $data);
       }
       else{
        return view('admin.grades.student_graded', $data);
       }

        
    }

    public function studentsGraded1(Request $request, $id, $assessment)
    {
        $data['id'] = $id;
        $data['assessment'] = $assessment;
        $data['title'] = 'Students Grading';

        if (!empty($request->registration)) {
            if ($request->assessment_id == '1') {
                foreach ($request->registration as $key => $registration) {
                    $student = Studentsubject::where('registration_no', $registration)->where('course_code', $request->coursecode)->first();
                    
                    //dd($student);
                    if (!empty($student)) {
                        $student->assessment1 = $request->assessment[$key] ?? null;
                        $student->save();
                       
                    }
                }

               
                return redirect(route('students.grading', ['id' => $id, 'assessment' => $assessment]))
                ->with('status', 'Students graded successfully1');
                //return view('admin.grades.student_grading', $data)->with('status', 'Students graded successfully!');

            } elseif ($request->assessment_id == '2') {
                foreach ($request->registration as $key => $registration) {
                    $student = Studentsubject::where('registration_no', $registration)->first();
                    if (!empty($student)) {
                        $student->assessment2 = $request->assessment[$key] ?? null;
                        $student->save();
                       
                    }
                }
                return redirect(route('students.graded1', ['id' => $id, 'assessment' => $assessment]))->with('status', 'Students graded successfully2');

            } elseif ($request->assessment_id == '3') {
                foreach ($request->registration as $key => $registration) {
                    $student = Studentsubject::where('registration_no', $registration)->first();
                    if (!empty($student)) {
                        $student->exam_grade = $request->assessment[$key] ?? null;
                        $student->save();

                        // Now select from lecturer subjects and compute final grade..
                    }
                }
             
                return redirect(route('students.graded1', ['id' => $id, 'assessment' => $assessment]))->with('status', 'Students graded successfully3');

            } 
            
            else {
                return view('admin.grades.student_grading', $data)->with('invalid', 'Something went wrong');
            }
        }
    }

    public function studentsGraded2($id, $assessment)
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

    public function submitHod($id)
    {
        $submitted = lecturerSubjects::find($id); // id of a subject in LecturerSubjects table
       // $submitted->classid;
       $lecturerSubjBasic = $submitted->basic;
        
       // dd($pclass->classcode, $pclass->classname, $pclass->under_basic);
        if($lecturerSubjBasic==1)
        {
            $pclass = Programclass::where('id',$submitted->classid)->where('campus_id', $submitted->campus_id)->first();
            $classCoordinator = $pclass->coordinator;
            $campus = $pclass->campus_id;
            if($campus==1){$campus = 'Lilongwe';};
            if($campus==2){$campus = 'Blantyre';};
            if($campus==3){$campus = 'Zomba';};
            //dd($classCoordinator);
            if(!empty($pclass))
            {   
               // if($pclass->classcode=='DCM1' || $pclass->classcode=='DCM1')
               // { COMPARE WITH CAMPUS AS WELL
                    $submitted->update([

                        'access_level' => $classCoordinator,
                    ]);
               // }
               return redirect()->back()->with('status', 'Assessment submitted to HOD basic'.' ' .$campus.'.');
               
            }
           
        } 
        elseif($lecturerSubjBasic==0)
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

                      'access_level' => $departmentHOD,
                    ]);
               // }
               
            }
            return redirect()->back()->with('status', 'Assessment submitted to Head, ' .$departmentID->department_name.' '. $campus. '.');
        }
       

       // return back();
    }
}
