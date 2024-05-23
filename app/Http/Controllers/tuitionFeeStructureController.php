<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class tuitionFeeStructureController extends Controller
{
    public function addFeeStructures(){
        return view('admin.tuitionFeeStructure.addTuitionFeeStructure');
    }

    public function viewFeeStructures(){
        return view('admin.tuitionFeeStructure.viewTuitionFeeStructure');
    }
}
