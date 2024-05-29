<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessmentlist extends Model
{
    use HasFactory;
    protected $fillable = [
        'assessment_name',
    ];
}
