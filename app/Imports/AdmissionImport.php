<?php

namespace App\Imports;

use App\Models\Admission;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class AdmissionImport implements ToModel
{
    protected $academic_yr_id;
    protected $id;

    function __construct($academic_yr_id, $id) {
        $this->academic_yr_id = $academic_yr_id;
        $this->id = $id;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
         // Skip empty rows
        if (empty($row[0]) && empty($row[10])) {
            return null;
        }
        
        $class = $row[4];
        $semester = $row[9];
        $campus = $row[5];
        $reference_code = $row[10];
    
        // Check for existing admission records
        $existingAdmission = Admission::where('class', $class)
            ->where('semester', $semester)
            ->where('campus', $campus)
            ->where('reference_code', $reference_code)
            ->first();
    
        // Skip the row if a record already exists in either table
        if (!empty($existingAdmission)) {
            return null;
        }
    
        // If no validation errors, proceed to create or update the admission record
            return new Admission([
                'academicyear' => $this->academic_yr_id,
                'uploadlist_id' => $this->id,
                'processed' => 0,
                'fname'    => $row[0], 
                'initials' => !empty($row[1]) ? $row[1] : null,
                'lname'     => $row[2],
                'dob' => $row[3],
                'class'     => $row[4],
                'campus'    => $row[5], 
                'email'    => $row[6], 
                'entry_level'    => $row[7], 
                'gender'    => $row[8],
                'semester'  => $row[9],
                'reference_code'    => $row[10],  // reference number i.e 1000/4000
                'reg_num' => !empty($row[11]) ? $row[11] : null, // Ensure empty value is treated as null
                'role'    => !empty($row[12]) ? $row[12] : 'student', // alumni if completed studies/null if student [see excel template]

            ]);
  
        
    }
}
