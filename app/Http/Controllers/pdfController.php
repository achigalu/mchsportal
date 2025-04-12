<?php

namespace App\Http\Controllers;

use App\Models\Academicyear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\savedExamNumbers;
use App\Models\Programclass;

class pdfController extends Controller
{
    public function viewExamNumbersPDF(Request $request, $pclass, $pcampus, $semester, $count, $acdyear)
    {

        $acy = Academicyear::find($acdyear);

        $stuNumbers = savedExamNumbers::where('pcode', $pclass)
        ->where('campus', $pcampus)
        ->where('semester', $semester)
        ->where('acdyear', $acdyear)
        ->get();
    
        $program = Programclass::where('classcode', $pclass)->first();

        $data = [
            'program' => $program->program->program_name,
            'pclass' => $pclass,
            'pcampus' => $pcampus,
            'semester' => $semester,
            'count' => $count,
            'acdyear' => $acy->ayear,
            'acmonth' => $acy->month,
            'acname' => $acy->name,
            'acdescription' => $acy->description,
            'acyear_id' => $acdyear,
            'stuNumbers' => $stuNumbers
        ];
       

        //$pdf = Pdf::loadView('admin.pdf.exam_numbers_pdf', $data);
        $pdf = Pdf::loadView('admin.pdf.classexam_numbers_pdf', $data)->setPaper('A4', 'landscape'); // Set to A4 landscape
        return $pdf->download($data['acdyear'].'_'.$pclass.'_'.$pcampus.'_Semester'.$semester.'_exam_numbers.pdf');

    }
}
