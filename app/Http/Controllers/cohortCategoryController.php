<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class cohortCategoryController extends Controller
{
    public function allIntakeCategories(){
        return view('admin.cohorts.allCohortCategories');
    }

    public function addIntakeCategory(){
        return view('admin.cohorts.addCohortCategory');
    }
}
