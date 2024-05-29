<?php

namespace App\Http\Controllers;

use App\Models\Studentsubject;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Programclass;
use App\Models\lecturerSubjects;
use App\Models\Myclasssubject;

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

        // retrieve data from db if table has grades.
       

        return view('admin.grades.student_grading', $data);
    }

    public function studentsGraded1(Request $request, $id, $assessment)
    {
        $data['id'] = $id;
        $data['assessment'] = $assessment;
        $data['title'] = 'Students Grading';

        if (!empty($request->registration)) {
            if ($request->assessment_id == '1') {
                foreach ($request->registration as $key => $registration) {
                    $student = Studentsubject::where('registration_no', $registration)->first();
                    if (!empty($student)) {
                        $student->assessment1 = $request->assessment[$key] ?? null;
                        $student->save();
                       
                    }
                }

               
                return redirect(route('students.graded2', ['id' => $id, 'assessment' => $assessment]))->with('status', 'Students graded successfully');
                //return view('admin.grades.student_grading', $data)->with('status', 'Students graded successfully!');

            } elseif ($request->assessment_id == '2') {
                foreach ($request->registration as $key => $registration) {
                    $student = Studentsubject::where('registration_no', $registration)->first();
                    if (!empty($student)) {
                        $student->assessment2 = $request->assessment[$key] ?? null;
                        $student->save();
                       
                    }
                }
                return redirect(route('students.graded2', ['id' => $id, 'assessment' => $assessment]))->with('status', 'Students graded successfully');

            } elseif ($request->assessment_id == '3') {
                foreach ($request->registration as $key => $registration) {
                    $student = Studentsubject::where('registration_no', $registration)->first();
                    if (!empty($student)) {
                        $student->exam_grade = $request->assessment[$key] ?? null;
                        $student->save();

                        // Now select from lecturer subjects and compute final grade..
                    }
                }
             
                return redirect(route('students.graded2', ['id' => $id, 'assessment' => $assessment]))->with('status', 'Students graded successfully');

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
}
