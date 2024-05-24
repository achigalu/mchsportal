<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Myclasssubject extends Model
{
    use HasFactory;
    protected $guarded = [];

    // relationships

public function course()
{
    return $this->belongsTo(Course::class);
}

public function programclass(){
    return $this->belongsTo(Programclass::class);
}

public function user()
{
    return $this->belongsToMany(User::class);
}


// static functions

static public function ClassSubject($class_id, $semester)
{
    return self::where('programclass_id', $class_id)->where('semester', $semester)->get();

}


}

