<?php

namespace App\Http\Controllers;

use App\Models\classExaMNumbers;
use App\Models\savedExamNumbers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\HtmlString;

class examnumbersController extends Controller
{
    public function getExamNumbers($pcode, $pcampus, $semester, $count)
    {
       $data['pcode']=$pcode;
       $data['pcampus']=$pcampus;
       $data['semester']=$semester;
       $data['count']=$count;
       return view('admin.examnumbers.generate_exam_number', $data);
    }

    public function generateExamNumbers(Request $request, $pcode, $pcampus, $semester, $count)
    {
        $validated = $request->validate([
            'max' => 'required', 'integer', 'min:1',
            'min' => 'required', 'integer', 'min:1',
        ]);

        if($request->min > $request->max)
        {
            return redirect()->back()
            ->withInput()  // Retains old input values
            ->with('invalid','Minimum number should be less than maximum number');
        }
        else
        {
            $difference = $request->max - $request->min;
            if($count > $difference + 1)
            {
                return redirect()->back()
                ->withInput()  // Retains old input values
                ->with('invalid','Total number of students in this class is more than the range of numbers specified.');  
            }

            else
            {
               // dd($request->pcode, $request->semester, $request->pcampus);
               $data['students'] = User::where('programclass', $pcode)
                    ->where('campus', $pcampus)
                    ->where('semester', $semester)->get();


               $count = $data['students']->count();


                    // $studentsWithNumbers = [];

                    // for ($i = 0; $i < $difference; $i++)
                    // {
                    //     $number = rand($request->min, $request->max);
                    //    // $formatedString = $request->pcode .'/'.$classCampus.'/0'.$request->semester.'/'.$number;
                    //     $newNumber = new Examnumbers();
                    //     $newNumber->exam_number_generated = $number;
                    //     $newNumber->save();
                    // }

                    // $savedNumbers = Examnumbers::all();
                    $uniqueNumbers = []; // Initialize an array to store unique random numbers

                    // Generate unique random numbers
                    while (count($uniqueNumbers) < count($data['students'])) {
                        $number = rand($request->min, $request->max);
                    
                        // Ensure the number is unique by checking the array
                        if (!in_array($number, $uniqueNumbers)) {
                            $uniqueNumbers[] = $number; // Add the unique number to the array
                        }
                    }
                    
                    // Ensure that we have enough unique numbers for all students
                    if (count($uniqueNumbers) >= count($data['students'])) {
                        // Iterate over each student and assign a unique number
                        $student = $data['students']->first();
                        $already = classExaMNumbers::where('pcode',$pcode)
                                    ->where('pcampus', $pcampus)
                                    ->where('semester', $semester)
                                    ->where('academic_yr', $student->academicyear_id)
                                    ->get(); // academic year.


                          
                            if($data['students']->isNotEmpty())
                            {

                                if($already->isNotEmpty())
                                {
                                    return redirect()->back()->with('invalid', new HtmlString('Examination numbers for: '.$pcode.' |'.$pcampus.'| Semester: ' .$semester.' already saved. ' 
                                    . $pcode . ' | ' . $pcampus . ' Semester: ' . $semester .' '
                                    . '<a href="'. route('view.class.examnumbers', ['pcode'=>$pcode, 
                                    'pcampus'=>$pcampus, 'semester'=>$semester, 'count'=>$count, 'saved'=>10]) . '">View it here</a>'));
                                }

                                else 
                                {
                                    foreach ($data['students'] as $index => $student) {
                                        // Get the corresponding unique number for the student
                                        $number = $uniqueNumbers[$index];
                                
                                        // Create the formatted student number
                                        if($pcampus=='Lilongwe'){$classCampus='LL';}
                                        if($pcampus=='Blantyre'){$classCampus='BT';}
                                        if($pcampus=='Zomba'){$classCampus='ZA';}
                                        $examNum = 'EN/'.$pcode . '/' . $classCampus . '/0' . $semester . '/' . $number;
                                
                                        // Output the student's number
                                       
                                        $saveNumbers = new classExaMNumbers();
                                        $saveNumbers->pcode = $pcode;
                                        $saveNumbers->pcampus = $pcampus;
                                        $saveNumbers->semester = $semester;
                                        $saveNumbers->reg_num = $student->reg_num;
                                        $saveNumbers->exam_number = $examNum;
                                        $saveNumbers->academic_yr = $student->academicyear_id;
                                        $saveNumbers->save();
            
                                    
                                
                                        // Optionally, save the student number to the database
                                        // Example:
                                        // $student->exam_number = $studentNum;
                                        // $student->save();
                                    }
                                    return redirect()->back()->with('status', new HtmlString('Examination numbers generated successfully. ' 
                                    . $pcode . ' | ' . $pcampus . ' Semester: ' . $semester .' '
                                    . '<a href="'. route('view.class.examnumbers', ['pcode'=>$pcode, 
                                    'pcampus'=>$pcampus, 'semester'=>$semester, 'count'=>$count, 'saved'=>10]) . '">View it here</a>'));
                                }
                                
                          
                            }
                        
                       
                       

                       

                        //return redirect()->back()->with('status', 'Examination numbers generated successfully.');

                    } 
     
            }
        }
       
    }

    public function viewClassExamNumbers($pcode, $pcampus, $semester, $count, $saved)
        {
            $examNumbers = classExaMNumbers::where('pcode',$pcode)
            ->where('pcampus', $pcampus)
            ->where('semester', $semester)
              // ->where('academic_yr', $academic_yr) // no need content to be deleted at every end of semester and insered into
              // another table for references
            ->get(); // academic year.

            $data['students'] = User::where('programclass', $pcode)
            ->where('campus', $pcampus)
            ->where('semester',$semester)->get();

            $data['singleStudent'] = $data['students']->first();

            if($examNumbers->isNotEmpty())
            {
                $data['title']='Class exam numbers';
                $data['pcode']=$pcode;
                $data['pcampus']=$pcampus;
                $data['semester']=$semester;
                $data['count']=$count;
                $data['stuWithExamNumbers']=$examNumbers;
                $data['saved'] = $saved;
              

                return view('admin.registration.class_list_for_exam_numbers', $data);
            }
            else
            {
                return redirect()->back()->with('invalid', 'No records found.');
            }
        }

        public function regenerateExamNumbers($pcode, $pcampus, $semester, $count)
        {

            $data['students'] = User::where('programclass', $pcode)
            ->where('campus', $pcampus)
            ->where('semester',$semester)->get();

           // dd($pcode, $pcampus, $semester, $count);
            $currentClassNumbers = classExaMNumbers::where('pcode',$pcode)
            ->where('pcampus', $pcampus)->where('semester', $semester)->get();
            if($currentClassNumbers->isNotEmpty())
            foreach ($currentClassNumbers as $classNumber)
            {
                $classNumber->delete();
            }
           
            return redirect()->route('get.exam.numbers',
            ['pclass'=>$pcode, 'pcampus'=>$pcampus, 'semester'=>$semester, 'count'=> $count]);

        }

        public function saveClassGeneratedExamNumbers($pcode, $pcampus, $semester, $count)
        {

            $data['title']='Saved class exam numbers';
                $data['classcode']=$pcode;
                $data['campus']=$pcampus;
                $data['semester']=$semester;
                $data['count']=$count;


            $students = User::where('programclass', $pcode)->where('campus', $pcampus)->where('semester', $semester)->get();
            $stu = $students->first();

            $already = savedExamNumbers::where('pcode', $pcode)
            ->where('campus', $pcampus)
            ->where('semester', $semester)
            ->where('acdyear', $stu->academicyear_id)
            ->get();

            $currentClassNumbers = classExaMNumbers::where('pcode',$pcode)
            ->where('pcampus', $pcampus)->where('semester', $semester)->get();

            $data['alreadySaved']=$already;
           // $data['alreadySaved']=$students;

            if($already->isNotEmpty())
            {
               
                return redirect()->route('student.exam.numbers', $data)->with('invalid', 'Examination numbers for: '.$pcode.' |'.$pcampus.'| Semester: ' .$semester.' already saved.');
            }
            elseif($already->isEmpty() && $currentClassNumbers->isNotEmpty())
            {
                foreach ($currentClassNumbers as $classNumber)
                {
                    $savedNumbers = new savedExamNumbers();
                    $savedNumbers->pcode = $pcode;
                    $savedNumbers->campus = $pcampus;
                    $savedNumbers->semester = $semester;
                    $savedNumbers->reg_num = $classNumber->reg_num;
                    $savedNumbers->exam_number = $classNumber->exam_number;
                    $savedNumbers->acdyear = $classNumber->academic_yr;
                    $savedNumbers->save();  
                }

                foreach ($currentClassNumbers as $classNumber)
                {
                  $classNumber->delete();  
                }

                $data['SavedNum']=$already;
                $data['title']='Students exam numbers.';
                $data['singleStudent'] = $stu;

                return redirect()->route('student.exam.numbers', $data)
                ->with('status', 'Examination numbers for: '.$pcode.' |'.$pcampus.'| Semester: ' .$semester.' saved successfully..');
            }

            else
            {



                // insert exam numbers into saved table

                $data['title']='Students exam numbers.';
                $data['singleStudent'] = $stu;
                $data['SavedNum']=$already;

                return view('admin.examnumbers.saved_exam_numbers', $data)
                ->with('status', 'Examination numbers for: '.$pcode.' |'.$pcampus.'| Semester: ' .$semester.' already saved 2.');
                            
            }
            } // End function

            public function deleteExamNumbersList($pclass, $pcampus, $semester, $count)
            {
                $data['title']='Delete class exam numbers';
                $data['pcode']=$pclass;
                $data['pcampus']=$pcampus;
                $data['semester']=$semester;
                $data['count']=$count;

            $students = User::where('programclass', $data['pcode'])->where('campus', $pcampus)->where('semester', $semester)->get();
            $stu = $students->first();

            $already = savedExamNumbers::where('pcode', $data['pcode'])
            ->where('campus', $pcampus)
            ->where('semester', $semester)
            ->where('acdyear', $stu->academicyear_id)
            ->get();

            foreach($already as $saved)
                {
                    $saved->delete();
                }
                
            return redirect()->route('student.exam.numbers')
            ->with('status', 'Examination numbers for: '.$pclass.' |'.$pcampus.'| Semester: ' .$semester.' deleted successfully');
            }

            public function studentFeesCheckbox(Request $request)
            {
                 // Get the array of student IDs from the request
                 $studentWithFees = $request->input('students');

                 $stuWithExamNumbers = savedExamNumbers::where('pcode', $request->pcode)
                ->where('campus', $request->campus)
                ->where('semester', $request->semester)
                ->where('acdyear', $request->acdyear)
                ->get();

                // $stuWithExamNumbers = savedExamNumbers::all(); // Fetch all variables from the database

                 if(!empty($studentWithFees))
                 {
                        foreach ($stuWithExamNumbers as $stu) {
                            // Check if the variable is in the selected array
                            if (in_array($stu->id, $studentWithFees)) {
                                // Set to 1 if selected
                                $stu->fee_status = 1;
                            } else {
                                // Set to 0 if not selected
                                $stu->fee_status = 0;
                            }

                            // Save the updated status
                            $stu->save();
                        }

                return redirect()->route('student.exam.numbers')->with('status', 'Students fees status updated successfully');
                }
                else
                {
                    return redirect()->route('student.exam.numbers')->with('status', 'Students fees status updated successfully');
                }

            }

       
}
