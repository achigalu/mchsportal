<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studentprofile extends Model
{
    use HasFactory;
    protected $guarded = [];
    //protected $fillable = [];


public function user()
{
    return $this->belongsTo(User::class);
}

}
