<?php

namespace App\Exports;

use App\Models\savedExamNumbers;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ClassExamNumberExport implements FromCollection, WithHeadings, WithStyles
{
     /**
    * @return \Illuminate\Support\Collection
    */

    protected $data;

     // Constructor to accept the data array
     public function __construct(array $data)
     {
         $this->data = $data;
     }

   
    public function collection()
    {
        return savedExamNumbers::select('pcode', 'semester', 'campus', 'reg_num', 'exam_number')
        ->where('pcode', $this->data['pclass'])         // Filter by class
        ->where('semester', $this->data['semester'])    // Filter by semester
        ->where('campus', $this->data['pcampus']) 
        ->where('acdyear', $this->data['acdyear'])       // Filter by campus
        ->get();        

        //return savedExamNumbers::select('pcode','semester','campus', 'reg_num', 'exam_number', 'created_at')->get();
    }

        // Add a heading row for the columns
        public function headings(): array
        {
            return [
                'PROGRAM CODE',   // Header for pcode
                'SEMESTER',       // Header for semester
                'CAMPUS',         // Header for campus
                'REGISTRATION NMBER',  // Header for reg_num
                'EXAMINATION NUMBER',    // Header for exam_number
                //'CREATED DATE'      // Header for created_at (optional, depends on whether it's relevant)
            ];
        }

            // Apply styles to the heading row
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]], // Make the first row (headings) bold
        ];
    }
}
