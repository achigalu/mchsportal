<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    use HasFactory;
    protected $guarded = [];

    /// Relationship functions here

    public function program()
    {
        return $this->hasMany(Program::class);
    }
    public function department()
    {
        return $this->hasMany(Department::class);
    }

    public function programclass()
    {
        return $this->hasMany(Programclass::class);
    }

    /// Static public functions here

    static public function campusAll()
    {
        return self::all();
    }

}
