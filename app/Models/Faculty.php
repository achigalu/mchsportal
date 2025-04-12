<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;
    protected $guarded = [];

    // Relationships
    // public functions

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function deputyDean() {
        return $this->belongsTo(User::class, 'dd_id'); // Deputy Dean
    }

    public function departments()
    {
        return $this->hasMany(Department::class);
    }





    // Static public functions

    static public function allFaculties()
    {

        return self::all();
    
    }

    static public function myfaculty($id)
    {
        return self::find($id);
    }
}
