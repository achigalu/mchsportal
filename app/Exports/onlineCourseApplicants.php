<?php

namespace App\Exports;

use App\Models\courseApplication;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use App\Models\Program;

class onlineCourseApplicants implements FromCollection, WithHeadings, WithStyles, WithMapping
{
    protected $courseId;

    public function __construct($id)
    {
        $this->courseId = $id;
    }

    public function collection()
    {
        return courseApplication::where('choice1_program_id', $this->courseId)
            ->get();
    }

    public function headings(): array
    {
        return [
            'REF.NO',
            'SURNAME',
            'FIRST NAME',
            'INITIALS',
            'AGE',
            'SEX',
            'CONTACT ADDRESS',
            'TEL NO',
            'HOME DISTRICT',
            '1ST CHOICE',
            '2ND CHOICE',
            '3RD CHOICE',
            'QUAL',
            'ENG',
            'MATH',
            'BIOL',
            'P/S',
            'PHYSICS',
            'CHEMISTRY',
            'G/S',
            'AGRI',
            'GEO',
            'H/EC',
            'SOCIAL',
            'L/S',
            'HIS',
            'BK',
            'CHIC',
            'BS',
            'COMPUTER',
            'ADD MATH',
            'S/F',
            'AGGR',
            'GRADE%',
            'REMARKS',
        ];
    }

    public function map($applicant): array
    {
        
        $choice1 = Program::findOrFail($applicant->choice1_program_id);
        $choice2 = Program::findOrFail($applicant->choice2_program_id);
        $choice3 = Program::findOrFail($applicant->choice3_program_id);
        if($applicant->sex == 'Female')
        {
            $mygender = 'F';
        }else
        {
            $mygender = 'M'; 
        }

        $i=1;
        return [
            $applicant->referenceno,
            $applicant->lname,
            $applicant->fname,
            $applicant->initials,
            $applicant->age,
            $mygender,
            $applicant->student_address,
            $applicant->student_phone1,
            $applicant->district,
            $choice1->program_code,
            $choice2->program_code,
            $choice3->program_code, 
            $applicant->qualification,
            $applicant->english_grade,
            $applicant->maths_grade,
            $applicant->biology_grade,
            $applicant->pscience_grade,
            $applicant->physics_grade, 
            $applicant->chemistry_grade,
            $applicant->gs_grade ?? ' ',
            $applicant->agriculture_grade,
            $applicant->geography_grade,
            $applicant->home_grade ?? ' ',
            $applicant->social_grade ?? ' ', 
            $applicant->lifes_grade ?? ' ', 
            $applicant->history_grade ?? ' ',
            $applicant->bk_grade ?? ' ', 
            $applicant->chichewa_grade ?? ' ',
            $applicant->bs_grade ?? ' ', 
            $applicant->computer_grade ?? ' ',
            $applicant->admath_grade ?? ' ', 

            $applicant->parent_guardian,
            $applicant->aggregate_grade,
            $applicant->grade_percentage ?? ' ',
            $applicant->remark ?? ' ',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the header row
            1 => [
                'font' => ['bold' => true],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'color' => ['argb' => 'FFD9D9D9']
                ]
            ],
            
            // Set column widths
            'A' => ['width' => 10],  // ID
            'B' => ['width' => 20],  // First Name
            'C' => ['width' => 20],  // Last Name
            'D' => ['width' => 30],  // Email
            'E' => ['width' => 20],  // Phone
            'F' => ['width' => 30],  // Course Name
            
            // Freeze the first row
            'A2:F1000' => [
                'alignment' => [
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP
                ]
            ]
        ];
    }
}