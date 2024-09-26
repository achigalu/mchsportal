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
     // Assuming 'reference_no' is a unique identifier for validation
    $referenceNo = $row[10];
    $reg_num = $row[11];
     // Fetch the record from the database based on 'reference_no'
     $existingAdmission = Admission::where('reference_code', $referenceNo)
     ->orWhere('reg_num', $reg_num)
     ->first();

    $existUser = User::where('reg_num', $reg_num)->first();

        // Perform your validation logic
        if ($existingAdmission) {
            // If the record exists, return null to skip the import
          //  return redirect()->route('confirm.students.lists', $this->id)->with('invalid', 'Reference numbers already exist in the system.');
            return null;
        }
        
        elseif($existUser)
        {
            return null;
        }


        else{

             // If no validation errors, proceed to create or update the admission record
        
             return new Admission([
                'academicyear' => $this->academic_yr_id,
                'uploadlist_id' => $this->id,
                'processed' => 0,
                'lname'     => $row[0],
                'initials' => $row[1],
                'fname'    => $row[2], 
                'dob' => $row[3],
                'class'     => $row[4],
                'campus'    => $row[5], 
                'email'    => $row[6], 
                'entry_level'    => $row[7], 
                'gender'    => $row[8],
                'semester'  => $row[9],
                'reference_code'    => $row[10],  // reference number i.e 1000/4000
                'reg_num'    => $row[11] ?? null, // registration numbers for students who joined college before system and for alumnis
                'role'    => $row[12] ?? 'student',  // alumni if completed studies/null if student [see excel template]

            ]);
        }
    
       
        
      
        
    }
}
