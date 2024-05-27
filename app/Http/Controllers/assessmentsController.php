<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('admin.grades.student_grading', $data);
    }

    public function studentsGraded1(Request $request)
    {
        dd($request->all());
    }
}
