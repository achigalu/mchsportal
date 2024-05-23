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
            ]);
        
      
        
    }
}
