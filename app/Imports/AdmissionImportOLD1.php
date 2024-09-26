<?php


namespace App\Imports;

use App\Models\Admission;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;

class AdmissionImport implements ToModel
{
    protected $academic_yr_id;
    protected $id;

    public function __construct($academic_yr_id, $id) {
        $this->academic_yr_id = $academic_yr_id;
        $this->id = $id;
    }

    public function model(array $row)
    {
        $referenceNo = $row[10];
        $reg_num = $row[11];

        if ($this->isExistingAdmission($referenceNo, $reg_num)) {
            return null; // Skip import if exists
        }

        $existUser = User::where('reg_num', $reg_num)->get();
        if ($existUser->isNotEmpty()) {
            return $this->handleExistingUsers($existUser);
        }

        return new Admission([
            'academicyear' => $this->academic_yr_id,
            'uploadlist_id' => $this->id,
            'processed' => 0,
            'lname' => $row[0],
            'initials' => $row[1],
            'fname' => $row[2], 
            'dob' => $row[3],
            'class' => $row[4],
            'campus' => $row[5], 
            'email' => $row[6], 
            'entry_level' => $row[7], 
            'gender' => $row[8],
            'semester' => $row[9],
            'reference_code' => $referenceNo,
            'reg_num' => $reg_num ?? null,
            'role' => $row[12] ?? 'student',
        ]);
    }

    protected function isExistingAdmission($referenceNo, $reg_num)
    {
        return Admission::where('reference_code', $referenceNo)
            ->orWhere('reg_num', $reg_num)
            ->exists();
    }

    protected function handleExistingUsers($existUser)
    {
        // Collect user names or handle accordingly
        return $existUser->map(function ($already) {
            return $already->fname . ' ' . $already->lname.' '. $already->reg_num;
        })->toArray();
    }
}