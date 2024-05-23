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

}




