<?php

namespace App\Http\Controllers;

use App\Models\Academicyear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Barryvdh\DomPDF\Facade\Pdf;

class pdfController extends Controller
{
    public function viewExamNumbersPDF(Request $request, $pclass, $pcampus, $semester, $count, $acdyear)
    {

        $acy = Academicyear::find($acdyear);
        $data['pclass'] = $pclass;
        $data['pcampus'] = $pcampus;
        $data['semester'] = $semester;
        $data['count'] = $count;
        $data['acdyear'] = $acy->ayear;

        $pdf = Pdf::loadView('admin.pdf.exam_numbers_pdf', $data);
        return $pdf->download($data['acdyear'].'_'.$pclass.'_'.$pcampus.'_Semester'.$semester.'_exam_numbers.pdf');

    }
}
