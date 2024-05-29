<?php

namespace App\Http\Controllers;

use App\Models\Academicyear;
use App\Imports\AdmissionImport;
use App\Models\Admission;
use App\Models\Campus;
use App\Models\Program;
use App\Models\Programclass;
use App\Models\Student;
use App\Models\Uploadlist;
use App\Models\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class studentController extends Controller
{
    public function addStudent(){
        return view('admin.intake.add_student');
    }

    public function uploadStudent(){
        $data['academicy'] = Academicyear::all();
        return view('admin.intake.upload_student', $data);
    }

    public function uploadedStudents(Request $request)
    {
        $validated = $request->validate([
           'students_upload' => 'required|file|mimes:csv,xls,xlsx|max:2048',
           'academic_yr_id' => 'required',
           'campus' => 'required',
           'intake_name' => 'required',
        ]);
       // dd($request->all());
      $intake_month = Academicyear::find($request->academic_yr_id);
      $mymonth = Academicyear::findmonth($intake_month->intake_name);
      $fomartdate = Carbon::parse($intake_month->month)->month;
      $formatedmonth = str_pad($fomartdate, 2, '0', STR_PAD_LEFT);
      $already = Uploadlist::where('academic_yr_id', $request->academic_yr_id)->where('intake_month',$formatedmonth)->where('campus',$request->campus)->where('upload_name',$request->intake_name)->first();
        if($validated){
            
            if(!empty($already))
            {
                return redirect(route('admission.student'))->with('invalid', 'Class list already uploaded');
            }
            Uploadlist::create([
                'academic_yr_id' => $request->academic_yr_id,
                'upload_name' => $request->intake_name,
                'intake_month' => $formatedmonth,
                'campus' => $request->campus,
                'user_id' => auth()->user()->id,
                'processed' => 0
                
            ]);

            if ($upload = Uploadlist::where('academic_yr_id', $request->academic_yr_id)->where('campus', $request->campus)->where('upload_name', $request->intake_name)->first()) {
            }

            $uploadedID = Uploadlist::find($upload->id);
            $id = $uploadedID->id;

            $already = Admission::where('academicyear', $request->academic_yr_id)->where('uploadlist_id', $id)->first();
            if(!empty($already))
            {
                return redirect(route('admission.student'))->with('invalid', 'Admission list already uploaded');
            }

            else
            {
                if($request->hasFile('students_upload')){
                    $import = new AdmissionImport($request->academic_yr_id, $id,);
                    Excel::import($import, request()->file('students_upload'));
        
                    return redirect(route('confirm.students.lists', $id));
            }
          
           }

       /// here we call blade file to validate the data and store it in another table (student table)
       
        return redirect()->back()->with('invalid', 'Something went wrong');  
           
        }
       
        // insert data into another table : student_admissions
        // values: academic_yr_id, upload_name, intake month, processed

        
        
    }

    public function admission(){
        $data['admission'] = Uploadlist::all();

        return view('admin.intake.admission_list', $data);
    }

    public function singleStudentAdmission(){
        return view('admin.intake.singleStudentAdd');
    }

    public function confirmStudentsList($id){
        $admissions = Uploadlist::find($id);

        $ayear_id = $admissions->academic_yr_id;
        $upload_id = $id;
        $data['upload_name'] = $admissions->upload_name;
        $data['admissions'] = Admission::where('academicyear', $ayear_id)->where('uploadlist_id', $upload_id)->orderBy('lname', 'asc') ->get();

        return view('admin.intake.confirmStudentsList', $data);
    }

    // same as above function only different views
    public function confirmStudentsLists($id){
        $admissions = Uploadlist::find($id);
        if(!empty($admissions))
        {
            if($admissions->processed==1)
            {   $class_students = Admission::where('uploadlist_id', $id)->first();
                $data['title'] = 'Uploaded Class List';
                $data['uploadedStudents'] = User::where('uploadlist_id' , $id)->get();
                $data['stu'] = User::where('programclass',$class_students->class)->where('academicyear_id', $class_students->academicyear)->first();
                 $data['academicyear'] = Academicyear::find($data['stu']->academicyear_id);
                return view('admin.intake.allAdmittedClassList', $data);
            }
            else
            {
                $ayear_id = $admissions->academic_yr_id;
                $upload_id = $id;
                $data['upload_id'] = $upload_id;
                $data['title'] = 'Uploaded Class List';
                $data['upload_name'] = $admissions->upload_name;
                $data['admissions'] = Admission::where('academicyear', $ayear_id)->where('uploadlist_id', $upload_id)->orderBy('lname', 'asc') ->get();
                $data['myclass'] = Programclass::all();
                $data['program'] = Program::all();
               // $data['single'] = Admission::where('uploadlist_id', $upload_id)->first();
                $data['campus'] = Campus::all();
                return view('admin.intake.confirmStudentsLists', $data);
            }

        }
        
    }

    public function discardUploadLists($id)
    {
        echo $id;
    }

    public function saveConfirmedStudents(Request $request, $id)
    {
        
        switch($request->input('action')) 
        {
            
                case 'discardlist':
                    return redirect()->route('discard.upload.lists', $id);
                    break;
                    case 'back':
                        return redirect()->route('admission.student');
                        break;
                            case 'savelist':
                               
                                $class = Programclass::where('classcode' , $request->class[0])->first();
                                // program code like CCM
                                $program_code = $class->program->program_code;
                                // campus like LL, BT or ZA
                                $campus = $request->campus[0];
                                if($campus== 'Lilongwe')
                                    {
                                        $campus_code = 'LL';
                                    }
                                else if($campus== 'Blantyre')
                                    {
                                        $campus_code = 'BT';
                                    }
                                else 
                                    {
                                        $campus_code = 'ZA';
                                    }
                                
                                    // year like 2024, 2020
                                $academic_yr = Academicyear::where('id', $request->acy[0])->first();
                                $intake_year = $academic_yr->ayear;
                                
                                    // Intake month like January = 01
                                $month = Uploadlist::where('academic_yr_id', $request->acy[0])->first();
                                $intake_month = $month->intake_month;
                                
                              
                                $uploadlist_id = $month->id;
                                
                                $reg_number = $program_code.'/'. $campus_code.'/'.$intake_year.'/0'.$intake_month.'/';
                               
                                $counter=00;
                                $email='@mchs.mw';
                                $campus = $request->campus[0];
                              
                                // need to use firstOrCreate method
                                $already = User::where('academicyear_id', $request->acy[0])
                                ->where('campus',  $request->campus[0])
                                ->where('uploadlist_id',  $id)
                                ->first(); 
                                
                                if(!empty($already))
                                {
                                   return redirect()->back()->with('invalid' , 'This class list was already uploaded');
                                }
                                else
                                {

foreach ($request->lname as $key => $lname) {
$counter++; // Increment counter within the loop
$formatted_counter = str_pad($counter, 2, '0', STR_PAD_LEFT); // Format counter with leading zeros

$email = strtolower($program_code . $campus_code . $intake_year . $intake_month . $formatted_counter . '@mchs.mw');
$checked_email = User::where('email', $email)->first();
if (!empty($checked_email)) {
return redirect()->back()->with('invalid', 'This students list was already uploaded');
}

User::create([
'academicyear_id' => $request->acy[$key],
'programclass' => $request->class[$key],
'uploadlist_id' => $id,
'reg_num' => $reg_number . $formatted_counter,
'fname' => $request->fname[$key],
'lname' => $request->lname[$key],
'entry_level' => $request->entry_type[$key],
'email' => $email, // Convert email to lowercase
'campus' => $campus,
'password' => Hash::make('password'),
'role' => 'student',
'semester' => 1,
'gender' => $request->gender[$key],
]);
}

                                }

               
                               $process = Uploadlist::find($id);
                               if(!empty($process))
                               {
                               
                                $process->update([
                                    'processed' => '1',
                                ]);
                               }
                                return redirect(route('saved.confirmed.students', $id));
                                //return view('admin.intake.confirmedStudents', $data);
                            
                     
                                break;
                
        }
                       
    }

    public function savedConfirmedStudents($id){

       
         // save data in bd and retrieve it for final confirmation
         $academic_yr = Academicyear::all();
         $prog_class = Programclass::all();  
         $class_students = Admission::where('uploadlist_id', $id)->first(); // we have student class, program, academiyear ..
         
         $data['students'] = User::where('programclass',$class_students->class)->where('academicyear_id', $class_students->academicyear)->where('campus', $class_students->campus)->get();
         //$data['confirmedstudents'] = Student::where('academicyear_id', $request->acy[0])->where('programclass', $request->class[0])->get();
         //dd($data['students']);
         //dd($data['confirmedstudents']);
         $data['stu'] = User::where('programclass',$class_students->class)->where('academicyear_id', $class_students->academicyear)->first();
         $data['academicyear'] = Academicyear::find($data['stu']->academicyear_id);
         $data['title'] = 'Confirmed Students List';
         $data['upload_status'] = $id;
         return view('admin.intake.confirmedStudents', $data);

    }

    public function deleteUploadList($id)
        {
            if(!empty($id))
            {
                Admission::where('uploadlist_id' , $id)->delete();
                Uploadlist::where('id' , $id)->delete();
            }
            return redirect(route('admission.student'))->with('status', 'Upload list deleted successfully');
        }

    public function finalAdmission()
    {
        return redirect(route('admission.student'))->with('status', 'Students admitted successfully');
    }

    public function studentsAdmissionDetails($id)
        {
 
            $data['allclassupload'] = User::where('uploadlist_id', $id)->get();

            $data['studentsingle'] = User::where('uploadlist_id', $id)->first();
            
                if(!empty($data['studentsingle']))
                {
                    return view('admin.intake.admitted_student_details', $data);
                }
                return redirect(route('admission.student'));
        }

    public function saveAdmissionStudent()
    {
        return redirect(route('admission.student'))->with('status', 'Students admitted successfully');
    }

   


































    // function to split a string into variables
    public function list(){

        // list function to split a string into each variable
        $addr="2023/01/18";
        list($name , $code , $place)=explode("/" , $addr);

        $all = $name . "-" .$code. "-" .$place;

        // differenciating given dates exploded from the list
        // count days between given dates

        $toDate = Carbon::parse('23-07-01');
        $fromDate = Carbon::parse('23-07-05');

        $diffDays = $toDate->diffInDays($fromDate);

        // differenciating weeks 
        // count months between given dates

        $toDate = Carbon::parse('23-01-01');
        $fromDate = Carbon::parse('23-07-01');

        $diffMonths = $toDate->diffInMonths($fromDate); 

        // count years between given dates

        $toDate = Carbon::parse('23-01-01');
        $fromDate = Carbon::parse('27-07-01');

        $diffYrs = $toDate->diffInYears($fromDate); 

        // count days between today's date and a specificdate

        $date = Carbon::parse('2023-07-01');
        $diffFromToday = today()->diffInDays($date);

        return view('list', compact('all','diffDays', 'diffMonths', 'diffYrs', 'diffFromToday'));
    }
}

