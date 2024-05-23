<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $guarded = [];

    /// Relationships 

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }

    public function programclass(){
        return $this->hasMany(Programclass::class);
    }


    /// Static public functions
    static public function allPrograms()
    {
        return self::all();
    }

    static public function result($code,$name,$department)
    {
        return self::where('program_code', $code)->where('program_name',$name)->where('department_id',$department)->first();
    }

    static public function programName($pname)
    {
       return self::where('program_name', $pname)->first();
    }

    static public function getProgram($id)
    {
        return self::find($id);
    }

    static public function getProgramCoordinator($id)
    {
        return self::find($id);
    } 
}
