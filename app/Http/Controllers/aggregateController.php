<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\lecturerSubjects;
use App\Models\Course;
use App\Models\Programclass;
use App\Models\User;
use App\Models\Studentsubject;
use App\Models\Academicyear;
use App\Models\Department;
use App\Models\Program;
use App\Models\StudentEvaluation;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Faculty;

class aggregateController extends Controller
{

//     public function aggregateSubject($id, $ay)
//     {
//         if (empty($id)) {
//             return redirect(route('list.assessments'))->with('status', 'No course selected');
//         }
    
//         $data['lecturerModule'] = lecturerSubjects::find($id);
//         $data['class'] = Programclass::where('id', $data['lecturerModule']->classid)->first();
//         $data['course'] = $data['lecturerModule'];
//         $data['coursename'] = Course::find($data['course']->courseid);
//         $data['lecturerid'] = $data['lecturerModule']->userid;
//         $data['lecturer'] = User::findOrFail($data['lecturerid']);

//         $data['stuGrades'] = Studentsubject::where('programclass_id', $data['lecturerModule']->classid)
//             ->where('semester', $data['lecturerModule']->semester)
//             ->where('campus_id', $data['lecturerModule']->campus_id)
//             ->where('academicyr_id', $ay)
//             ->where('course_code', $data['coursename']->code)
//             ->get();
    
//         foreach ($data['stuGrades'] as $stuSub) {
//             $assessdb = Studentsubject::where([
//                 'user_id' => $stuSub->user_id,
//                 'programclass_id' => $stuSub->programclass_id,
//                 'semester' => $stuSub->semester,
//                 'course_code' => $stuSub->course_code,
//             ])->first();
    
//             if (!$assessdb) {
//                 Log::error('Studentsubject record not found', [
//                     'user_id' => $stuSub->user_id,
//                     'programclass_id' => $stuSub->programclass_id,
//                     'semester' => $stuSub->semester,
//                     'course_code' => $stuSub->course_code,
//                 ]);
//                 continue;
//             }
    
//             $assessed40 = null;
//             if ($stuSub->assessment1 !== null && $stuSub->assessment2 !== null) {
//                 $averageScore = ($stuSub->assessment1 + $stuSub->assessment2) / 2;
//                 $assessed40 = $averageScore * 0.4;
//             } elseif ($stuSub->assessment1 !== null || $stuSub->assessment2 !== null) {
//                 $assessed40 = (($stuSub->assessment1 ?? 0) + ($stuSub->assessment2 ?? 0)) / 2 * 0.4;
//             }
    
//             $assessed60 = $stuSub->exam_grade !== null ? $stuSub->exam_grade * 0.60 : null;
//             $final_grade = ($assessed40 ?? 0) + ($assessed60 ?? 0);

//              // Update database with computed values
//             $assessdb->update([
//                 'computed40' => $assessed40,
//                 'computed60' => $assessed60,
//                 'final_grade' => $final_grade,
//             ]);
    
//         }

//         $campus = 'Unknown';

//         if($data['lecturerModule']->campus_id == 1) {
//             $campus = 'LL';
//         } elseif($data['lecturerModule']->campus_id == 2) {
//             $campus = 'BT';
//         }
//         elseif($data['lecturerModule']->campus_id == 3){
//             $campus = 'ZA';
//         }

//         // counting, passes, repeat, sup, fail
//         $data['stuCount'] = $data['stuGrades']->count();

//        // Ensure stuCount is not zero to avoid division by zero errors
// $stuCount = $data['stuCount'] > 0 ? $data['stuCount'] : 1;

// // Pass
// $data['passCount'] = $data['stuGrades']->filter(fn($student) => $student->final_grade >= 50)->count();
// $data['passRate'] = round(($data['passCount'] / $stuCount) * 100, 2);

// // Sup (Supplementary)
// $data['supCount'] = $data['stuGrades']->filter(fn($student) => $student->final_grade >= 40 && $student->final_grade < 50)->count();
// $data['supRate'] = round(($data['supCount'] / $stuCount) * 100, 2);

// // Repeat
// $data['repeatCount'] = $data['stuGrades']->filter(fn($student) => $student->final_grade < 40)->count();
// $data['repeatRate'] = round(($data['repeatCount'] / $stuCount) * 100, 2);


//         $data = [
//             'aggregatedGrades' =>  $data['stuGrades'],
//             'stuCount' => $data['stuCount'],
//             'passCount' => $data['passCount'],
//             'passRate' => $data['passRate'],
//             'supCount' => $data['supCount'],
//             'supRate' => $data['supRate'],
//             'repeatCount' => $data['repeatCount'],
//             'repeatRate' => $data['repeatRate'],
//             'coursename' => $data['coursename'],
//             'class' => $data['class'],
//             'lecturerModule' => $data['lecturerModule'],
//             'campus' => $campus,
//             'lecturerid' => $data['lecturerid'],
//             'lecturer' => $data['lecturer'],
//             'title' => 'Aggregating Subject',
//             'id' => $id, 
//             'ay' => $ay,
//             'fname' => $data['lecturer']->fname,
//             'lname' => $data['lecturer']->lname,
//             'stuGrades' => $data['stuGrades']
//         ];

//         $data['averageFinalGrade'] = $data['stuGrades']->avg('final_grade');
//         return view('admin.aggregate.aggregatesubject', $data);

//         $data['averageFinalGrade'] = $data['stuGrades']->avg('final_grade');
//         $pdf = PDF::loadView('admin.aggregate.subjectPDF', $data)->setPaper('A4', 'landscape'); // Set to A4 landscape
//         return $pdf->download($data['coursename']->code . '_' . $data['class']->classcode .'_semester'. $data['lecturerModule']->semester.'_'. $campus .'.pdf'); // Stream instead of download
//   }
   
    public function aggregateSubject($id, $ay){

        if(empty($id))
        {
            return redirect(route('list.assessments'))->with('status', 'No course selected');
        }

        $data['lecturerModule'] = lecturerSubjects::find($id);
        $data['class'] = Programclass::where('id', $data['lecturerModule']->classid)->first();
        $data['course'] = $data['lecturerModule'];
        $data['coursename'] = Course::find($data['course']->courseid);
        $data['lecturerid'] = $data['lecturerModule']->userid;
        $data['lecturer'] = User::findOrFail($data['lecturerid']);
        $fname = $data['lecturer']->fname;
        $lname = $data['lecturer']->lname;
        
        $data['stuGrades'] = Studentsubject::where('programclass_id', $data['lecturerModule']->classid)
        ->where('semester', $data['lecturerModule']->semester)
        ->where('campus_id', $data['lecturerModule']->campus_id)
        ->where('academicyr_id', $ay)
        ->where('course_code', $data['coursename']->code)
        ->get(); // developed@AndyChigalu

        $stuSubjects = $data['stuGrades'];

        foreach ($stuSubjects as $stuSub) {
            // Fetch subject record (ensure it exists before updating)
            $assessdb = Studentsubject::where([
                'user_id' => $stuSub->user_id,
                'programclass_id' => $stuSub->programclass_id,
                'semester' => $stuSub->semester,
                'course_code' => $stuSub->course_code,
            ])->first();
        
            if (!$assessdb) {
                // Debugging: Log missing record
                Log::error('Studentsubject record not found for:', [
                    'user_id' => $stuSub->user_id,
                    'programclass_id' => $stuSub->programclass_id,
                    'semester' => $stuSub->semester,
                    'course_code' => $stuSub->course_code,
                ]);
                continue; // Skip this iteration
            }
        
            // Compute 40% from assessments (out of 40)
            $assessed40 = null;
            if ($stuSub->assessment1 !== null && $stuSub->assessment2 !== null) {
                $averageScore = ($stuSub->assessment1 + $stuSub->assessment2)/2;
                $assessed40 = $averageScore * 0.4; // Convert to 40%
            }elseif($stuSub->assessment1 !== null || $stuSub->assessment2 !== null){
                $assessed40 = ($stuSub->assessment1 + $stuSub->assessment2)/2 * 0.4;
            }
        
            // Compute 60% from the exam (out of 60)
            $assessed60 = null;
            if ($stuSub->exam_grade !== null) {
                $assessed60 = $stuSub->exam_grade * 0.60; // Convert to 60%
            }
        
            // Compute final grade (total should be out of 100)
            $final_grade = null;
            if ($assessed40 !== null || $assessed60 !== null) {
                $final_grade = ($assessed40 ?? 0) + ($assessed60 ?? 0);
            }
        
            // Update database with computed values
            $assessdb->update([
                'computed40' => $assessed40,
                'computed60' => $assessed60,
                'final_grade' => $final_grade,
            ]);
        }
        
        $data['aggregatedGrades'] = Studentsubject::where('programclass_id', $data['lecturerModule']->classid)
        ->where('semester', $data['lecturerModule']->semester)
        ->where('campus_id', $data['lecturerModule']->campus_id)
        ->where('academicyr_id', $ay)
        ->where('course_code', $data['coursename']->code)
        ->get(); // developed@AndyChigalu


        $campus = 'Unknown';

        if($data['lecturerModule']->campus_id == 1) {
            $campus = 'LL';
        } elseif($data['lecturerModule']->campus_id == 2) {
            $campus = 'BT';
        }
        elseif($data['lecturerModule']->campus_id == 3){
            $campus = 'ZA';
        }

        // counting, passes, repeat, sup, fail
        $data['stuCount'] = $data['aggregatedGrades']->count();

        //pass
        $data['passCount'] = $data['aggregatedGrades']->filter(function ($student) {
            return $student->final_grade >= 50;
        })->count();
        $data['passRate'] = round(($data['passCount'] / $data['stuCount']) * 100, 2);

        //sup
        $data['supCount'] = $data['aggregatedGrades']->filter(function ($student) {
            return $student->final_grade >= 40 && $student->final_grade < 50;
        })->count();
        $data['supRate'] = round(($data['supCount'] / $data['stuCount']) * 100, 2);

        //repeat
        $data['repeatCount'] = $data['aggregatedGrades']->filter(function ($student) {
            return $student->final_grade < 40;
        })->count();
        $data['repeatRate'] = round(($data['repeatCount'] / $data['stuCount']) * 100, 2);

        $data = [
            'aggregatedGrades' => $data['aggregatedGrades'],
            'stuCount' => $data['stuCount'],
            'passCount' => $data['passCount'],
            'passRate' => $data['passRate'],
            'supCount' => $data['supCount'],
            'supRate' => $data['supRate'],
            'repeatCount' => $data['repeatCount'],
            'repeatRate' => $data['repeatRate'],
            'coursename' => $data['coursename'],
            'class' => $data['class'],
            'lecturerModule' => $data['lecturerModule'],
            'campus' => $campus,
            'lecturerid' => $data['lecturerid'],
            'lecturer' => $data['lecturer'],
            'title' => 'Aggregating Subject',
           'id' => $id, //courseid in lecturer_subjects table
            'ay' => $ay,
            'fname' => $fname,
            'lname' => $lname,
            'stuGrades' => $data['stuGrades'],
            'lecturerModule' => $data['lecturerModule'],
            'course' => $data['course'],
        ];

        $data['averageFinalGrade'] = $data['aggregatedGrades']->avg('final_grade'); 
        return view('admin.aggregate.aggregatesubject', $data);
    }

    public function aggregatedSubjectPDF($id, $ay)
    {
        if (empty($id)) {
            return redirect(route('list.assessments'))->with('status', 'No course selected');
        }
    
        $data['lecturerModule'] = lecturerSubjects::find($id);
        $data['class'] = Programclass::where('id', $data['lecturerModule']->classid)->first();
        $data['course'] = $data['lecturerModule'];
        $data['coursename'] = Course::find($data['course']->courseid);
        $data['lecturerid'] = $data['lecturerModule']->userid;
        $data['lecturer'] = User::findOrFail($data['lecturerid']);

        $data['stuGrades'] = Studentsubject::where('programclass_id', $data['lecturerModule']->classid)
            ->where('semester', $data['lecturerModule']->semester)
            ->where('campus_id', $data['lecturerModule']->campus_id)
            ->where('academicyr_id', $ay)
            ->where('course_code', $data['coursename']->code)
            ->get();
    
        foreach ($data['stuGrades'] as $stuSub) {
            $assessdb = Studentsubject::where([
                'user_id' => $stuSub->user_id,
                'programclass_id' => $stuSub->programclass_id,
                'semester' => $stuSub->semester,
                'course_code' => $stuSub->course_code,
            ])->first();
    
            if (!$assessdb) {
                Log::error('Studentsubject record not found', [
                    'user_id' => $stuSub->user_id,
                    'programclass_id' => $stuSub->programclass_id,
                    'semester' => $stuSub->semester,
                    'course_code' => $stuSub->course_code,
                ]);
                continue;
            }
    
            $assessed40 = null;
            if ($stuSub->assessment1 !== null && $stuSub->assessment2 !== null) {
                $averageScore = ($stuSub->assessment1 + $stuSub->assessment2) / 2;
                $assessed40 = $averageScore * 0.4;
            } elseif ($stuSub->assessment1 !== null || $stuSub->assessment2 !== null) {
                $assessed40 = (($stuSub->assessment1 ?? 0) + ($stuSub->assessment2 ?? 0)) / 2 * 0.4;
            }
    
            $assessed60 = $stuSub->exam_grade !== null ? $stuSub->exam_grade * 0.60 : null;
            $final_grade = ($assessed40 ?? 0) + ($assessed60 ?? 0);
    
        }

        $campus = 'Unknown';

        if($data['lecturerModule']->campus_id == 1) {
            $campus = 'LL';
        } elseif($data['lecturerModule']->campus_id == 2) {
            $campus = 'BT';
        }
        elseif($data['lecturerModule']->campus_id == 3){
            $campus = 'ZA';
        }

        // counting, passes, repeat, sup, fail
        $data['stuCount'] = $data['stuGrades']->count();

       // Ensure stuCount is not zero to avoid division by zero errors
$stuCount = $data['stuCount'] > 0 ? $data['stuCount'] : 1;

// Pass
$data['passCount'] = $data['stuGrades']->filter(fn($student) => $student->final_grade >= 50)->count();
$data['passRate'] = round(($data['passCount'] / $stuCount) * 100, 2);

// Sup (Supplementary)
$data['supCount'] = $data['stuGrades']->filter(fn($student) => $student->final_grade >= 40 && $student->final_grade < 50)->count();
$data['supRate'] = round(($data['supCount'] / $stuCount) * 100, 2);

// Repeat
$data['repeatCount'] = $data['stuGrades']->filter(fn($student) => $student->final_grade < 40)->count();
$data['repeatRate'] = round(($data['repeatCount'] / $stuCount) * 100, 2);


        $data = [
            'stuCount' => $data['stuCount'],
            'passCount' => $data['passCount'],
            'passRate' => $data['passRate'],
            'supCount' => $data['supCount'],
            'supRate' => $data['supRate'],
            'repeatCount' => $data['repeatCount'],
            'repeatRate' => $data['repeatRate'],
            'coursename' => $data['coursename'],
            'class' => $data['class'],
            'lecturerModule' => $data['lecturerModule'],
            'campus' => $campus,
            'lecturerid' => $data['lecturerid'],
            'lecturer' => $data['lecturer'],
            'title' => 'Aggregating Subject',
            'id' => $id, 
            'ay' => $ay,
            'fname' => $data['lecturer']->fname,
            'lname' => $data['lecturer']->lname,
            'stuGrades' => $data['stuGrades']
        ];

        $data['averageFinalGrade'] = $data['stuGrades']->avg('final_grade');
        $pdf = PDF::loadView('admin.aggregate.subjectPDF', $data)->setPaper('A4', 'landscape'); // Set to A4 landscape
        return $pdf->download($data['coursename']->code . '_' . $data['class']->classcode .'_semester'. $data['lecturerModule']->semester.'_'. $campus .'.pdf'); // Stream instead of download
    }

    public function aggregateClassGrades(){

    $classes = Programclass::all();
    $AuthUser = Auth::user()->role;

    if(Auth::user()->role=='HOD-BASIC') // Campus Registrar
    {
        $campus = Auth::user()->campus;
            if($campus == 'Lilongwe')
              {
                  $campus = '1';
              }
            if($campus == 'Blantyre')
              {
                  $campus = '2';
              }
            if($campus == 'Zomba')
              {
                  $campus = '3';
              }
        $hodBasic = Programclass::where('campus_id', $campus)->where('coordinator', Auth::user()->id)->get();
        return view('admin.aggregate.class_aggregate_class', compact('classes', 'hodBasic'));

    }
    elseif($AuthUser == 'HOD'){
      $hod = Department::where('user_id', auth()->id())->first();

      if ($hod) // hod
      {
          // Get all programs under the department
          $programs = Program::where('department_id', $hod->id)->get();
      
          // Get all classes related to those programs
          $hodClasses = Programclass::whereIn('program_id', $programs->pluck('id'))->get();
      }
           return view('admin.aggregate.class_aggregate_class', compact('classes', 'hodClasses'));  

    }
    
    elseif ($AuthUser == 'Dean') // Dean
    {
        $facultyDean = Faculty::where('user_id', auth()->id())->first();
    
        if ($facultyDean) {
            // Get all department IDs under this faculty
            $deanDepartmentIds = Department::where('faculty_id', $facultyDean->id)->pluck('id');
    
            // Get all program IDs under these departments
            $deanProgramIds = Program::whereIn('department_id', $deanDepartmentIds)->pluck('id');
    
            // Get all program classes under these programs
            $deanClasses = ProgramClass::whereIn('program_id', $deanProgramIds)->get();

        }
        return view('admin.aggregate.class_aggregate_class', compact('classes', 'deanClasses'));
    }

    elseif(Auth::user()->role=='Campus Registrar' || Auth::user()->role=='Principal') // Campus Registrar
    {
        $campus = Auth::user()->campus;
            if($campus == 'Lilongwe')
              {
                  $campus = '1';
              }
            if($campus == 'Blantyre')
              {
                  $campus = '2';
              }
            if($campus == 'Zomba')
              {
                  $campus = '3';
              }
        $cr = Programclass::where('campus_id', $campus)->get();
        return view('admin.aggregate.class_aggregate_class', compact('classes', 'cr'));
        
    }
    elseif(Auth::user()->role=='DCR-Academic' ||
     Auth::user()->role=='DCR-Administration' ||
      Auth::user()->role=='College Registrar' ||
       Auth::user()->role=='Executive Director' || 
       Auth::user()->role=='Admin' ||
        Auth::user()->role=='Administrator') // Lecturer
        {
          $co = Programclass::all();
          return view('admin.aggregate.class_aggregate_class', compact('classes', 'co'));
        }
          
    elseif(Auth::user()->role=='Lecturer'){ // Lecturer
    // Get unique class IDs, semester, and campus_id for the authenticated lecturer
    $lecturerClasses = lecturerSubjects::where('userid', auth()->id())
    ->select('classid', 'semester', 'campus_id')
    ->groupBy('classid', 'semester', 'campus_id')
    ->get();

        $classDetails = []; // Array to store class details

        if ($lecturerClasses->isNotEmpty()) {
            foreach ($lecturerClasses as $class) {
                $classDetails[] = Programclass::find($class->classid); // Collect each class
            }
        }
        
        return view('admin.aggregate.class_aggregate_class', compact('classes', 'classDetails'));
      } 
      else{
        return view('admin.aggregate.class_aggregate_class');
      }
    }

    // public function aggregateClassMarks(Request $request, $ay = null, $class = null, $semester = null)
    // {
    //     if(empty($ay) || empty($class) || empty($semester))
    //     {
    //     $ay = $request->acyID;
    //     $class = $request->classID;
    //     $semester = $request->semester;
        

    //                     $campus = Programclass::findOrFail($class);
    //                     $myclass = $campus;
    //                     $campusID = null;
    //                     if(!empty($campus))
    //                     {
    //                         $campusID = $campus->campus_id;
    //                     }

    //                     // Step 1: Get distinct course codes
    //                                 $courseCodes = Studentsubject::select('course_code')
    //                                 ->where('programclass_id', $class)
    //                                 ->where('academicyr_id', $ay)
    //                                 ->where('campus_id', $campusID)
    //                                 ->where('semester', $semester)
    //                                 ->distinct()
    //                                 ->pluck('course_code');

    //                             if($courseCodes->isNotEmpty())
    //                             {
    //                                 // Step 2: Retrieve all the grades for the class, academic year, and semester
    //                             $grades = Studentsubject::select('registration_no','user_id', 'course_code', 'final_grade')
    //                             ->where('programclass_id', $class)
    //                             ->where('academicyr_id', $ay)
    //                             ->where('campus_id', $campusID)
    //                             ->where('semester', $semester)
    //                             ->get();

    //                         // Step 3: Organize the grades into a pivot-like structure
    //                         $pivotedGrades = [];

    //                         foreach ($grades as $grade) {
    //                             $pivotedGrades[$grade->registration_no][$grade->course_code] = $grade->final_grade;
    //                         }

    //                         // Step 4: Prepare the headers dynamically
    //                         $headers = ['registration#']; // This is for the first column (student registration number)
    //                         foreach ($courseCodes as $courseCode) {
    //                             $headers[] = $courseCode;
    //                         }

    //                         // Step 5: Prepare the final result to return
    //                         $finalResults = [];
    //                         foreach ($pivotedGrades as $registration_no => $studentGrades) {
    //                             $row = ['registration_no' => $registration_no];
    //                             foreach ($courseCodes as $courseCode) {
    //                                 // Fill in the grade or NULL if the student did not take the course
    //                                 $row[$courseCode] = $studentGrades[$courseCode] ?? null;
    //                             }
    //                             $finalResults[] = $row;
    //                         }

    //                         $campus = '';
    //                             if($campusID == 1) {$mycampus = 'Lilongwe';}
    //                             if($campusID == 2) {$mycampus = 'Blantyre';}
    //                             if($campusID == 3) {$mycampus = 'Zomba';}

    //                             $acyear = Academicyear::findOrFail($ay);

    //                         return view('admin.aggregate.grades_aggregated_for_class', compact('headers', 'finalResults', 'myclass', 'acyear', 'mycampus', 'semester', 'ay', 'class'));

    //                         }
    //                         else
    //                         {
    //                             $ay = Academicyear::findOrFail($ay);

    //                             $campus = '';
    //                             if($campusID == 1) {$mycampus = 'Lilongwe';}
    //                             if($campusID == 2) {$mycampus = 'Blantyre';}
    //                             if($campusID == 3) {$mycampus = 'Zomba';}

                                
    //                             return redirect()->back()->with('invalid', 'No grades to aggregate for class: '.$campus->classcode. '|' .$ay->ayear.'-' .$ay->description.' Sem:'  .$semester . ' '.$mycampus);
    //                         }
            
    //      } else {
    //         //////// i want to export to pdf the same thing as above
    //         }     
    // }

public function aggregateClassMarks(Request $request, $ay = null, $class = null, $semester = null, $publish = null)
{
    if (empty($ay) || empty($class) || empty($semester)) {
        // Get parameters from form request
        $ay = $request->acyID;
        $class = $request->classID;
        $semester = $request->semester;
    }

     // Get Class & Campus Details
     $campus = Programclass::findOrFail($class);
     $myclass = $campus;
     $campusID = $campus->campus_id ?? null;

    // Step 1: Get distinct course codes
    $courseCodes = Studentsubject::select('course_code')
        ->where('programclass_id', $class)
        ->where('academicyr_id', $ay)
        ->where('campus_id', $campusID)
        ->where('semester', $semester)
        ->distinct()
        ->pluck('course_code');

    if ($courseCodes->isNotEmpty()) {
        // 
        // Query the subject table to get the subject names
        $courses = Course::whereIn('code', $courseCodes)->select('code', 'name')->get();
        session()->put([
            'courses' => $courses,
        ]);

        // Step 2: Retrieve all the grades
        $grades = Studentsubject::select('registration_no', 'user_id', 'course_code', 'final_grade')
            ->where('programclass_id', $class)
            ->where('academicyr_id', $ay)
            ->where('campus_id', $campusID)
            ->where('semester', $semester)
            ->get();

        // Step 3: Organize the grades into a pivot-like structure
        $pivotedGrades = [];
        foreach ($grades as $grade) {
            $pivotedGrades[$grade->registration_no][$grade->course_code] = $grade->final_grade;
        }

        // Step 4: Prepare the headers dynamically
        $headers = ['registration#'];
        foreach ($courseCodes as $courseCode) {
            $headers[] = $courseCode;
        }

        // Step 5: Prepare the final result
        $finalResults = [];
        foreach ($pivotedGrades as $registration_no => $studentGrades) {
            $row = ['registration_no' => $registration_no];
            foreach ($courseCodes as $courseCode) {
                $row[$courseCode] = $studentGrades[$courseCode] ?? null;
            }
            $finalResults[] = $row;
        }

        // Campus Name
        $mycampus = match ($campusID) {
            1 => 'Lilongwe',
            2 => 'Blantyre',
            3 => 'Zomba',
            default => 'Unknown',
        };

        $acyear = Academicyear::findOrFail($ay);

        // If URL parameters exist, generate PDF
        if ($request->route()->parameters()) {

            if (is_null($publish)) {
                // Do this if $publish is null
                $data = compact('headers', 'finalResults', 'myclass', 'acyear', 'mycampus', 'semester', 'ay', 'class');

                $pdf = Pdf::loadView('admin.aggregate.class_aggregated_subjectsPDF', $data)->setPaper('A4', 'landscape');
                return $pdf->download("{$myclass->classcode}_semester{$semester}_{$mycampus}.pdf");

            } else {
                // Do this if $publish is not null
                return view('admin.aggregate.grades_aggregated_for_class', compact('headers', 'finalResults', 'myclass', 'acyear', 'mycampus', 'semester', 'ay', 'class','campusID'))
                ->with('status', 'The grades have been successfully published.');
            }


        }

        // Otherwise, return the web view
        return view('admin.aggregate.grades_aggregated_for_class', compact('headers', 'finalResults', 'myclass', 'acyear', 'mycampus', 'semester', 'ay', 'class','campusID'));
    }

    // Handle No Grades Case
    $acyear = Academicyear::findOrFail($ay);
    $mycampus = match ($campusID) {
        1 => 'Lilongwe',
        2 => 'Blantyre',
        3 => 'Zomba',
        default => 'Unknown',
    };

    return redirect()->back()->with('invalid', "No grades to aggregate for class: {$campus->classcode} | {$acyear->ayear}-{$acyear->description} Sem: {$semester} {$mycampus}");
}

public function unpublishClassModules($ay, $class, $semester, $campus)
{
    if ($ay || $class || $semester || $campus) {
        // Retrieve the student access for the specific course and academic year
       $allStudentSubjs = Studentsubject::where('academicyr_id', $ay)
       ->where('programclass_id', $class)
       ->where('semester', $semester)
       ->where('campus_id', $campus)
       ->get();
    
        }
       if ($allStudentSubjs->isEmpty()) {
           return redirect()->route('aggregate.class.marks2', ['ay'=>$ay, 'class'=>$class, 'semester'=>$semester])
           ->with('status', 'Nothing to publish on this class');
       }
    
       foreach ($allStudentSubjs as $studentSubj) {
           $studentSubj->update([
               'access_final_grade' => 0,
           ]);
       }
    
       $campus = Programclass::findOrFail($class);
       $campusID = $campus->campus_id ?? null;
       $mycampus = match ($campusID) {
        1 => 'Lilongwe',
        2 => 'Blantyre',
        3 => 'Zomba',
        default => 'Unknown',
       };
    
       return redirect()->route('aggregate.class.marks2', ['ay'=>$ay, 'class'=>$class, 'semester'=>$semester, 'publish'=>1])
           ->with('invalid', 'End of semester results for '.$campus->classcode.' | '.$mycampus.' - Semester '.$semester.' un-published successfully.');
}



public function publishClassModules($ay, $class, $semester, $campus)
{
    if ($ay || $class || $semester || $campus) {
    // Retrieve the student access for the specific course and academic year
   $allStudentSubjs = Studentsubject::where('academicyr_id', $ay)
   ->where('programclass_id', $class)
   ->where('semester', $semester)
   ->where('campus_id', $campus)
   ->get();

   $studentaccess = Studentsubject::where('academicyr_id', $ay)
    ->where('programclass_id', $class)
    ->where('semester', $semester)
    ->where('campus_id', $campus)
    ->get();

    $studentaccessSingle = $studentaccess->first();

    $hasAccess = $studentaccess->contains('access_final_grade', $studentaccessSingle->access_final_grade);

    }
   if ($allStudentSubjs->isEmpty()) {
       return redirect()->route('aggregate.class.marks2', ['ay'=>$ay, 'class'=>$class, 'semester'=>$semester])
       ->with('status', 'Nothing to publish on this class');
   }

   foreach ($allStudentSubjs as $studentSubj) {
       $studentSubj->update([
           'access_final_grade' => 1,
       ]);
   }

   $campus = Programclass::findOrFail($class);
   $campusID = $campus->campus_id ?? null;
   $mycampus = match ($campusID) {
    1 => 'Lilongwe',
    2 => 'Blantyre',
    3 => 'Zomba',
    default => 'Unknown',
   };

   return redirect()->route('aggregate.class.marks2', ['ay'=>$ay, 'class'=>$class, 'semester'=>$semester, 'publish'=>1])
       ->with('status', 'End of semester results for '.$campus->classcode.' | '.$mycampus.' - Semester '.$semester.' published successfully.');
}

public function signingOffClass($ay, $class, $semester, $campus)
{
    $campusID = Programclass::where('id', $class)->value('campus_id');

    // Step 1: Get student grades
    $grades = Studentsubject::where('programclass_id', $class)
        ->where('academicyr_id', $ay)
        ->where('semester', $semester)
        ->when($campusID, fn($query) => $query->where('campus_id', $campusID))
        ->select('registration_no', 'user_id', 'final_grade')
        ->get();

    // Step 2: Group grades by student
    $studentGrades = [];
    foreach ($grades as $grade) {
        $studentGrades[$grade->registration_no]['user_id'] = $grade->user_id;
        $studentGrades[$grade->registration_no]['grades'][] = $grade->final_grade;
    }

    // Step 3: Evaluate students
    foreach ($studentGrades as $reg_no => $data) {
        $user_id = $data['user_id'];
        $gradesArray = $data['grades'];
        
        // Compute average grade
        $averageGrade = round(array_sum($gradesArray) / count($gradesArray));

        // Count failed and supplementary grades
        $failCount = collect($gradesArray)->filter(fn($grade) => $grade < 40)->count();
        $supCount = collect($gradesArray)->filter(fn($grade) => $grade >= 40 && $grade < 50)->count();

        // Determine remark
        if ($failCount == 0 && $supCount == 0) {
            $remark = "Pass";
        } elseif ($supCount > 0 && $supCount <= 2 && $failCount == 0) {
            $remark = "Sup";
        } else {
            $remark = "Fail";
        }

        // Save/update student evaluation record
        StudentEvaluation::updateOrCreate(
            [
                'user_id' => $user_id,
                'class_id' => $class,
                'academicyr_id' => $ay,
                'campus_id' => $campusID,
                'semester' => $semester,
            ],
            [
                'average_grade' => $averageGrade,
                'registration_no' => $reg_no,
                'remark' => $remark
            ]
        );
    }

    return response()->json(['message' => 'Student evaluations recorded successfully.']);
}


}






