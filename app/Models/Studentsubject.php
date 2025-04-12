<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studentsubject extends Model
{
    use HasFactory;
    protected $guarded = [];


    //
    public function course(){
    
        return $this->belongsTo(Course::class);
    }
    
    public function user()
{
    return $this->belongsTo(User::class, 'user_id'); // assuming 'user_id' is the foreign key in 'studentsubject'
}
}

