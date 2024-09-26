<?php

namespace App\Exports;

use App\Models\savedExamNumbers;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use App\Models\User;

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
             // Step 1: Get saved exam numbers based on your filters
    $savedExamNumbers = savedExamNumbers::select('pcode', 'semester', 'campus', 'reg_num', 'exam_number')
    ->where('pcode', $this->data['pclass'])
    ->where('semester', $this->data['semester'])
    ->where('campus', $this->data['pcampus'])
    ->where('acdyear', $this->data['acdyear'])
    ->get();
         // Step 2: Get the reg_nums from saved exam numbers
         $regNums = $savedExamNumbers->pluck('reg_num');
     
         // Step 3: Fetch users with matching reg_nums
         $users = User::whereIn('reg_num', $regNums)->get();
     
         // Step 4: Combine the data
         $combinedData = $savedExamNumbers->map(function ($examNumber) use ($users) {
             $user = $users->firstWhere('reg_num', $examNumber->reg_num);
     
             return [
                'lname' => $user ? $user->lname : null, // or other user fields as needed
                'fname' => $user ? $user->fname : null, // or other user fields as needed
                 'pcode' => $examNumber->pcode,
                 'semester' => $examNumber->semester,
                 'campus' => $examNumber->campus,
                 'reg_num' => $examNumber->reg_num,
                 'exam_number' => $examNumber->exam_number,
                 
                 
             ];
         });
     
         return $combinedData;
     }

        // Add a heading row for the columns
        public function headings(): array
        {
            return [
                'SURNAME',
                'FIRST NAME',
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
