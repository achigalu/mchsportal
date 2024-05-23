<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;
    protected $table ='semesters';
    protected $fillable = ['academicyear_id','semester','ssdate','sedate', 'rsdate','redate', 'is_semester_final'];


    // Relationships here

   public function academicyear(){

    return $this->belongsTo(Academicyear::class);
   }



    // End Relationships here

    // Static public functions here
    static public function  getAcedemicYearSemesters($id){
        return self::where('academicyear_id', $id)->orderBy('semester', 'ASC')->get();
    }

    static public function getSingle($id)
    {
        return self::find($id);
    }
    


    // End Static public functions here
}



