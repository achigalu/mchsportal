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
            if($count > $difference)
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

                       

                                    $already2 = savedExamNumbers::where('pcode', $pcode)
                                    ->where('campus', $pcampus)
                                    ->where('semester', $semester)
                                    ->where('acdyear', $student->academicyear_id)
                                    ->get();

                        if($already2->isNotEmpty())
                        {
                            $saved = 9;
                            if($already->isNotEmpty())
                            {
                             
                                return redirect()->back()->with('invalid', new HtmlString('Examination numbers already generated for class ' 
                                . $pcode . ' | ' . $pcampus . ' Semester: ' . $semester .' '
                                . '<a href="'. route('view.class.examnumbers', ['pcode'=>$pcode, 
                                'pcampus'=>$pcampus, 'semester'=>$semester, 'count'=>$count, 'saved'=>$saved]) . '">View it here</a>'));
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
                                $examNum = $pcode . '/' . $classCampus . '/0' . $semester . '/' . $number;
                        
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
                            }
                        }
                        else
                        {

                            if($already->isNotEmpty())
                            {
                                $saved = 10;
                                return redirect()->back()->with('invalid', new HtmlString('Examination numbers already generated for class ' 
                                . $pcode . ' | ' . $pcampus . ' Semester: ' . $semester .' '
                                . '<a href="'. route('view.class.examnumbers', ['pcode'=>$pcode, 
                                'pcampus'=>$pcampus, 'semester'=>$semester, 'count'=>$count, 'saved'=>$saved]) . '">View it here</a>'));
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
                                $examNum = $pcode . '/' . $classCampus . '/0' . $semester . '/' . $number;
                        
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
                            }
                        }
                       
                      

                        return redirect()->back()->with('status', new HtmlString('Examination numbers generated successfully. ' 
                        . $pcode . ' | ' . $pcampus . ' Semester: ' . $semester .' '
                        . '<a href="'. route('view.class.examnumbers', ['pcode'=>$pcode, 
                        'pcampus'=>$pcampus, 'semester'=>$semester, 'count'=>$count, 'saved'=>10]) . '">View it here</a>'));

                        return redirect()->back()->with('status', 'Examination numbers generated successfully.');

                    } 
     
            }
        }
       
    }

    public function viewClassExamNumbers($pcode, $pcampus, $semester, $count, $saved)
        {
            $already = classExaMNumbers::where('pcode',$pcode)
            ->where('pcampus', $pcampus)
            ->where('semester', $semester)
              // ->where('academic_yr', $academic_yr) // no need content to be deleted at every end of semester and insered into
              // another table for references
            ->get(); // academic year.

            if($already->isNotEmpty())
            {
                $data['title']='Class exam numbers';
                $data['pcode']=$pcode;
                $data['pcampus']=$pcampus;
                $data['semester']=$semester;
                $data['count']=$count;
                $data['students']=$already;
                $data['saved'] = $saved;
              

                return view('admin.examnumbers.class_exam_numbers', $data);
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

        public function saveClassGenerateExamNumbers($pcode, $pcampus, $semester, $count)
        {
           
            $students = User::where('programclass', $pcode)->where('campus', $pcampus)->where('semester', $semester)->get();
            $stu = $students->first();

            $data['saveexamnumbers'] = classExaMNumbers::where('pcode', $pcode)
            ->where('pcampus', $pcampus)
            ->where('semester', $semester)
            ->get();

            $savedexamnumbers =  $data['saveexamnumbers']->first();

            $already = savedExamNumbers::where('pcode', $pcode)
            ->where('campus', $pcampus)
            ->where('semester', $semester)
            ->where('acdyear', $stu->academicyear_id)
            ->get();

            if($already->isNotEmpty())
            {
                $saved = 9;

                return redirect()->route('view.class.examnumbers', 
                ['pcode'=>$pcode, 
                'pcampus'=>$pcampus,
                'semester'=>$semester,
                'count'=>$count, 
                'saved'=>$saved])->with('invalid', 'Examination numbers for this class already saved.');
            }
            else
            {
                $academic_yr = $savedexamnumbers->academic_yr;

                foreach($data['saveexamnumbers'] as $savedexamnum)
                {
                    $numberSave = new savedExamNumbers();
                    $numberSave->pcode = $pcode;
                    $numberSave->exam_number = $savedexamnum->exam_number;
                    $numberSave->semester = $semester;
                    $numberSave->acdyear = $academic_yr;
                    $numberSave->campus = $pcampus;
                    $numberSave->reg_num = $savedexamnum->reg_num;
                    $numberSave->save();
                }
                return redirect()->route('view.class.examnumbers', ['pcode'=>$pcode, 
                            'pcampus'=>$pcampus, 'semester'=>$semester, 'count'=>$count, 'saved'=>10])->with('status', 'Registration numbers saved successfully');
            }
            }

       
}
