<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Programclass;

class gradeController extends Controller
{
    public function listOldStudents()
    {
        $classes = Programclass::all();
        $groupedClasses = [];
        
        if ($classes->isNotEmpty()) {
            foreach ($classes as $class) {
                $campusId = $class->campus_id;
                
                // Initialize the array for this campus_id if it doesn't exist
                if (!isset($groupedClasses[$campusId])) {
                    $groupedClasses[$campusId] = [];
                }
                
                // Add the class to the array for this campus_id
                $groupedClasses[$campusId][] = $class;
            }
        }
        
        // Now you can use $groupedClasses as needed
        // For example, to create a search list of campus IDs:
        $campusList = array_keys($groupedClasses);
    
        return view('admin.grades.old_students', compact('classes'));
    } // end function

    public function listCurrentStudents()
    {
        $classes = Programclass::all();
        $groupedClasses = [];
        
        if ($classes->isNotEmpty()) {
            foreach ($classes as $class) {
                $campusId = $class->campus_id;
                
                // Initialize the array for this campus_id if it doesn't exist
                if (!isset($groupedClasses[$campusId])) {
                    $groupedClasses[$campusId] = [];
                }
                
                // Add the class to the array for this campus_id
                $groupedClasses[$campusId][] = $class;
            }
        }
        
        // Now you can use $groupedClasses as needed
        // For example, to create a search list of campus IDs:
        $campusList = array_keys($groupedClasses);

        return view('admin.grades.current_students', compact('classes'));
    }

    public function searchOldStudents(Request $request)
    {
        $request->validate([
            'acyID' => 'required',
            'classID' => 'required',
            'semester' => 'required',
        ]);

        $academicyear = $request->acyID;
        $programclassID = $request->classID;
        $semester = $request->semester;

        // $programClass = Programclass::find($programclassID); // Keep the original object
    
       // $program = $programClass->program; // Access the related Program model
       // $programcampus = $program->campus_id;
       // $programclass = $programClass->classcode; // Use the original object
    
       // dd($academicyear, $program, $programcampus, $semester, $programclass);

        
        
        $programClass = Programclass::find($programclassID);
        $program = $programClass->program_id;
        $programcampus = $programClass->campus_id;
        $programclass = $programClass->classcode;

        dd(
            $academicyear,
            $program,
            $programcampus,
            $semester,
            $programclass
         );

         // Select old students based on above attributes...

        

    }

    public function searchCurrentStudents(Request $request)
    {
        dd($request->all());
        // Enter grades on behalf of the lecturers...
    }

    public function configOldClassSubjects(Request $request)
    {
        dd($request->all());
    }
}


