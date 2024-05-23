<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uploadlist extends Model
{
    use HasFactory;
    protected $table = 'uploadlists';
    protected $fillable = [
        'academic_yr_id',
        'upload_name',
        'user_id',
        'campus',
        'intake_month',
        'processed'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

