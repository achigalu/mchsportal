<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Academicyear;
use App\Models\Semester;
use Illuminate\Support\Carbon;

class cohortsemesters extends Controller
{
    public function allCohortSemesters($id){
        $data['title'] = 'Cohort Semesters';
        $data['single'] = Academicyear::getSingle($id);
        $data['academic_year_semesters'] = Semester::getAcedemicYearSemesters($id);
        return view('admin.cohorts.viewCohortSemesters', $data);
    }

    public function addCohortSemester($id){
        $data['title'] = 'Add Cohort Semester';
        $data['single'] = Academicyear::getSingle($id);
        return view('admin.cohorts.addCohortSemester' , $data);
    }

    public function createCohortSemester(Request $request , $id)
    {
        $request->validate([
            'snumber' => 'required|integer',
            'ssdate' => 'required|date',
            'sedate' => 'required|date',
            'sisfinal' => 'required'
        ]);
        /// automating creation of registration period
        $date = Carbon::createFromFormat('Y-m-d', $request->ssdate);
        $date = Carbon::parse($date)->toDateString();
        $newDate = Carbon::parse($date);
        $formdate = 14;
        $newDate->addDays($formdate);
        $myNewDate = $newDate->toDateString();

        if(!empty($id) && (!empty($myNewDate)))
        {
                Semester::create([
                    'academicyear_id' => $id,
                    'semester' => $request->snumber,
                    'ssdate' => $request->ssdate,
                    'sedate' => $request->sedate,
                    'rsdate' => $request->ssdate,
                    'redate' => $myNewDate,
                    'is_semester_final' => $request->sisfinal
                    
                ]);
                return redirect()->back()->with('status', 'Semester' ." ".$request->snumber." " . 'created successfully');
            }
              
            
            return redirect()->back()->with('invalid', 'Something went wrong');  
        
        
          
        
    }
    public function editCohortSemester($id){
        $data['title'] = 'Edit Cohort Semesters';
        $data['editSemester'] = Semester::getSingle($id);
        
        return view('admin.cohorts.editCohortSemester', $data);
    }

    public function updateSemester(Request $request, $id)
    {
        $request->validate([
            
            'ssdate' => 'required|date',
            'sedate' => 'required|date',
            'sisfinal' => 'required' 
        ]);

        $mySemester = Semester::getSingle($id);
        if(!empty($mySemester))
        {
            $mySemester->update([
                    
                
                'ssdate' => $request->ssdate,
                'sedate' => $request->sedate,
                'is_semester_final' => $request->sisfinal
            ]);
            return redirect()->back()->with('status', 'Semester' ." ".$request->snumber . 'updated successfully');
        }
      
        return redirect()->back()->with('invalid', 'Something went wrong');
    }

    public function updateCohortSemesterRegistration($id)
    {   
        $data['title'] = 'Edit Cohort Semester';
        $data['semester'] = Semester::getSingle($id);
        return view('admin.cohorts.editsemesterRegistration', $data);
        
    }

    public function updateSemesterRegistration(Request $request, $id)
    {
        $data['title'] = 'Update registration dates';
        $single = Semester::getSingle($id);
        if(!empty($single))
        {
            $single->update([
                'rsdate' => $request->rsdate,
                'redate' => $request->redate,
            ]);
            return redirect()->back()->with('status', 'Registration period for' ." ".$single->academicyear->ayear." " .$single->academicyear->description. " " ."semester: " .$single->semester ." ". 'updated successfully');
        }
        return redirect()->back()->with('invalid', 'Something went wrong.');
    }
}
