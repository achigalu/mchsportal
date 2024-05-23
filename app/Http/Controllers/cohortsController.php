<?php

namespace App\Http\Controllers;

use App\Models\Academicyear;
use Carbon\Carbon;
use Illuminate\Http\Request;

class cohortsController extends Controller
{
    public function viewCohorts(){
        $data['title'] = 'Create new Cohort';
        $data['allcohorts'] = Academicyear::getAll();
        return view('admin.cohorts.viewCohort', $data);
    }

    public function addCohort(){
        $data['title'] = 'Add cohort';
        return view('admin.cohorts.addCohort' ,$data);
    }

    public function createCohorts(Request $request)
    {
        $validated = $request->validate([
            'ayear' => 'required|numeric|digits:4',
            'month' => 'required',
            'description' => 'required|max:255',
            'category' => 'required',
            'sdate' => 'required|date',
            'edate' => 'required|date'
        ]);

        if($validated)
        {
            $already = Academicyear::where('ayear', $request->ayear)->where('description', $request->description)->where('month', $request->month)->first();
           
            if(!empty($already))
            {
                return redirect()->back()->with('invalid' , 'Academic year already exist');  
            }
           Academicyear::create([
            'ayear' => $request->ayear,
            'sdate' => $request->sdate,
            'edate' => $request->edate,
            'month' => $request->month,
            'description' => $request->description,
            'category' => $request->category,
            'status' => '1'
           ]); 
           return redirect()->back()->with('status', 'Academic year' ." ".$request->ayear." : ".$request->description. " ".'created successfully');
        }
    }

    public function editCohort($id){
        $data['title'] = 'Edit Cohort';
        $data['single'] = Academicyear::getSingle($id);
        return view('admin.cohorts.editCohort', $data);
    }

    public function updateCohorts(Request $request , $id)
    {
        $request->validate([
            'ayear' => 'required|numeric|digits:4',
            'month' => 'required',
            'description' => 'required|max:255',
            'category' => 'required',
            'sdate' => 'required|date',
            'edate' => 'required|date'
        ]);

        if(!empty($id))
        {
            $single = Academicyear::getSingle($id);
            $single->update([
            'ayear' => $request->ayear,
            'sdate' => $request->sdate,
            'edate' => $request->edate,
            'month' => $request->month,
            'description' => $request->description,
            'category' => $request->category,
            'status' => $single->status

            ]);
        return redirect()->back()->with('status', 'Academic year' ." ".$request->ayear.' ' .$request->description. " ".'updated successfully');
        }
    }
}
