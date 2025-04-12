<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Studentsubject;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Programclass;
use App\Models\Campus;

class reportsController extends Controller
{
    public function downloadStudentSemesterReport()
    {
        $student = Auth::user();
        $campus = $student->campus;
        $studentProgram = $student->program->program_name;
        $ac_year = $student->academicyear->ayear;
        $ac_month = $student->academicyear->month;
        $ac_name = $student->academicyear->description;
        $reg_num = $student->reg_num;
        $semester = $student->semester;
        $class = $student->programclass;

                    // Initialize the $myCampus variable to a default value
                $myCampus = null;

                // Check the value of $campus and assign the correct campus ID
                if ($campus == 'Lilongwe') {
                    $myCampus = 1;
                } elseif ($campus == 'Blantyre') {
                    $myCampus = 2;
                } elseif ($campus == 'Zomba') {
                    $myCampus = 3;
                }

        $myclass = Programclass::where('classcode', $class)->where('campus_id', $myCampus)->first();
       
        $stuSemesterSubjects = Studentsubject::where('user_id', $student->id)
        ->where('programclass_id', $myclass->id)
        ->where('semester', $semester)->get();

        $data = [
            'student' => $student,
            'stuSemesterSubjects' => $stuSemesterSubjects,
            'campus' => $campus,
            'studentProgram' => $studentProgram,
            'ac_year' => $ac_year,
            'ac_month' => $ac_month,
            'ac_name' => $ac_name,
            'reg_num' => $reg_num,
            'semester' => $semester,
            'class' => $class
        ];

        if($campus=='Lilongwe')
        {
            $pdf = PDF::loadView('admin.pdf.studentLL_semester_reportPDF', $data)->setPaper('A4', 'portrait'); // Set to A4 landscape
            return $pdf->download($data['student']->fname . '_' . $data['student']->lname . '_school_report.pdf'); // Stream instead of download
        }
        elseif($campus=='Blantyre')
        {
            $pdf = PDF::loadView('admin.pdf.studentBT_semester_reportPDF', $data)->setPaper('A4', 'portrait'); // Set to A4 landscape
            return $pdf->download($data['student']->fname . '_' . $data['student']->lname . '_school_report.pdf'); // Stream instead of download    
        }
        else
        {
            $pdf = PDF::loadView('admin.pdf.studentZA_semester_reportPDF', $data)->setPaper('A4', 'portrait'); // Set to A4 landscape
            return $pdf->download($data['student']->fname . '_' . $data['student']->lname . '_school_report.pdf'); // Stream instead of download
        }

       

    }
}
