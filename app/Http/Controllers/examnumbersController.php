<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class examnumbersController extends Controller
{
    public function getExamNumbers($pcode, $pcampus, $semester)
    {
        echo $pcode . ' '. $pcampus. ' '. $semester;
    }
}
