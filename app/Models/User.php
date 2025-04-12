<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

   // Relationships
    // public functions

    public function faculty()
    {
        return $this->hasOne(Faculty::class);
    }

    public function department()
    {
        return $this->hasOne(Department::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id'); // Ensure 'program_id' is the correct foreign key
        //return $this->hasMany(Program::class);
    }

    public function uploadlist(){
     return $this->hasMany(Uploadlist::class);
    }

    public function academicyear()
    {
        return $this->belongsTo(Academicyear::class);
    }

    public function programclass()
    {
        return $this->belongsTo(Programclass::class);
    }

    // public function myclasssubject()
    // {
    //     return $this->belongsToMany(Myclasssubject::class);
    // }

    public function myclasssubject()
    {
        return $this->belongsToMany(Myclasssubject::class, 'myclasssubject_user', 'user_id', 'myclasssubject_id');
    }

    public function studentprofile()
    {
        return $this->hasOne(Studentprofile::class);
    }


    // static public functions

    static public function allUsers(){
        return self::whereNotIn('role', ['Admin', 'College Registrar','DCR-Academic', 'DCR-Administration', 'Administrator',
        'College Accountant','student','applicant','Accounts','Campus Registrar','Executive Director'])->get();
    }

    static public function alreadyUser($id)
    {
        return self::find($id);
    }

 
         
}
