<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programclass extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Relation ships

    public function program(){
        return $this->belongsTo(Program::class);
    }
    public function myclasssubject(){
        return $this->hasMany(Myclasssubject::class);
    }

    public function feecategory(){
        return $this->belongsTo(Feecategory::class);
    }

    public function campus(){
        return $this->belongsTo(Campus::class);
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }

    // static public function 
     static public function getClasses($id)
     {
        return self::find($id);
     }

     static public function getProgramclass($class_id)
     {
        return self::where('id', $class_id)->first();
     }
}
