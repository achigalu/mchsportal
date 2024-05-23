<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relationships
    // public functions

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function program()
    {
        return $this->hasMany(Program::class);
    }
    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }




    // static public functions

    public static function facultyDepartments($id)
    {
        return self::where('faculty_id' , $id)->get();
    }

     public static function getSingle($id)
     {
        return self::find($id);
     }

     public static function allDepartments()
     {
        return self::all();
     }
}
