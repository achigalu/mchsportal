<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $guarded = [];

    /// relationships 

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function studentsubject(){
        return $this->hasMany(Studentsubject::class);
    }

    public function myclasssubject()
    {
        return $this->hasMany(Myclasssubject::class);
    }

    /// static public functions

    static public function alreadyCode($code)
    {
        return self::where('code' , $code)->first();
    }

    static public function alreadyCourseName($name)
    {
        return self::where('name', $name)->first();
    }


    static public function getAllCourses()
    {
        return self::all();
    }

    public static function courseToEdit($id)
    {
        return self::find($id);
    }
    
}
