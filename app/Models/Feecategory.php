<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feecategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    /// Relationships

    public function programclass(){
        return $this->hasMany(Programclass::class);
    }

    /// static public functions

    static public function alreadyFeeCategoryCode($code){
        return self::where('feecode' , $code)->first();
    }

    static public function alreadyFeeCategoryname($name){
        return self::where('feename',$name)->first();
    }

    static public function getAllFeeCategoryList(){
        return self::all();
    }

    static public function singleFeeCategory($id){
        return self::find($id);
    }
}
