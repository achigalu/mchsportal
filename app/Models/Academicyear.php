<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Academicyear extends Model
{
    use HasFactory;
    protected $guarded = [];

    /// Relationships here
    public function semester()
    {
        return $this->hasMany(Semester::class);
    }   

    public function user()
    {
        return $this->hasMany(User::class);
    }

    /// End Relationships here

    /// static public functions here 

    static public function getAll()
    {
        return self::orderBy('id', 'ASC')->get();
    }
    static public function getSingle($id)
    {
        return self::find($id);
    }
    static function findmonth($month)
    {
        
        if($month== 'January')
        {
            return '01';
        }
       else if($month== 'February')
        {
            return  '02';
        }
        else if($month== 'March')
        {
            return  '03';
        }
       else if($month== 'April')
        {
            return  '04';
        }
        else if($month== 'May')
        {
            return  '05';
        }
       else if($month== 'June')
        {
            return  '06';
        }
        else if($month== 'July')
        {
            return  '07';
        }
       else if($month== 'August')
        {
            return  '08';
        }
        else if($month== 'September')
        {
            return  '09';
        }
       else if($month== 'October')
        {
            return '10';
        }
        else if($month== 'November')
        {
            return '11';
        }
        else
        {
            return '12';
        }
    }

}
