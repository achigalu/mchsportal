<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ClassExamNumberExport;
use App\Models\Academicyear;

class excelController extends Controller
{
    public function viewExamNumbersEXCEL($pclass, $pcampus, $semester, $count, $acdyear)
    {
        // Fetch the academic year record
        $acy = Academicyear::find($acdyear);
        
        // Prepare the data to pass to the export
        $data = [
            'pclass' => $pclass,
            'pcampus' => $pcampus,
            'semester' => $semester,
            'count' => $count,
            'acdyear' => $acdyear,
        ];

        // Pass the $data array to the export class and generate the Excel file
        return Excel::download(new ClassExamNumberExport($data), $acy->ayear.'_'.$pclass.'_'.$pcampus.'_Semester'.$semester.'_exam_numbers.xlsx');
    }
}