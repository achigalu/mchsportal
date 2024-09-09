<?php

namespace App\Imports;

use App\Models\Admission;
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
     // Assuming 'reference_no' is a unique identifier for validation
    $referenceNo = $row[8];
     // Fetch the record from the database based on 'reference_no'
    $existingAdmission = Admission::where('reference_code', $referenceNo)->first();
        // Perform your validation logic
        if ($existingAdmission) {
            // If the record exists, return null to skip the import
          //  return redirect()->route('confirm.students.lists', $this->id)->with('invalid', 'Reference numbers already exist in the system.');
            return null;
        }
    
        // If no validation errors, proceed to create or update the admission record
        
            return new Admission([
                'academicyear' => $this->academic_yr_id,
                'uploadlist_id' => $this->id,
                'processed' => 0,
                'fname'     => $row[0],
                'lname'    => $row[1], 
                'class'     => $row[2],
                'campus'    => $row[3], 
                'email'    => $row[4], 
                'entry_level'    => $row[5], 
                'gender'    => $row[6],
                'semester'  => $row[7],
                'reference_code'    => $row[8],  // reference number i.e 1000/4000
                'reg_num'    => $row[9] ?? null, // registration numbers for students who joined college before system and for alumnis
                'role'    => $row[10] ?? 'student',  // alumni if completed studies/null if student

            ]);
        
      
        
    }
}
