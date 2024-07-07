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
use Illuminate\Support\Facades\Auth;
use App\Models\Studentprofile;

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
      //$mymonth = Academicyear::findmonth($intake_month->intake_name);
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
        
                    $checkedReferenceCode = Admission::where('academicyear', $request->academic_yr_id)->where('uploadlist_id', $id)->first();
                    if(!empty($checkedReferenceCode))
                    {
                        return redirect(route('confirm.students.lists', $id));
                        
                    }else{
                        return redirect(route('confirm.students.lists', $id))->with('invalid', 'Reference numbers already exist in the system.');
                    }
                   
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
                $data['ayear_id'] = $admissions->academic_yr_id;
                $upload_id = $id;
                $data['upload_id'] = $upload_id;
                $data['title'] = 'Uploaded Class List';
                $data['upload_name'] = $admissions->upload_name;
                $data['admissions'] = Admission::where('academicyear', $data['ayear_id'])->where('uploadlist_id', $upload_id)->orderBy('lname', 'asc') ->get();
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
                               
                                // check if some students are already uploaded - count to add extra
                                // check if 
                         $class = Programclass::where('classcode' , $request->class[0])->first();
                            
                         if (!$class)
                                {
                                    return redirect()->route('confirm.students.lists', $id)->with('invalid', 'This'.' '.$request->class[0].' '.' class not defined.');
                                }
                              
                         else{ 
                                // more logic for validating reg numbers...    
                               // $data['reference_code'] = Admission::where('reference_code', )->where('uploadlist_id', $upload_id)->orderBy('lname', 'asc') ->get();   
                               // program code like CCM

                                $oldStudents = Admission::where('academicyear', $request->acy[0])->where('uploadlist_id', $id)
                                ->where('campus',  $request->campus[0])->get();
                                // Check if any of the old students have a non-empty reg_num
                                                $hasRegNum = $oldStudents->pluck('reg_num')->filter()->isNotEmpty();

                                                if ($hasRegNum) {
                                                // There are students with non-empty reg_num values
                                                foreach ($request->lname as $key => $lname) {
                                                   
                                                    $email = $request->reg_num[$key].'@mchs.mw';
                                                    $checkOldRegNum = User::where('reg_num', $request->reg_num[$key])->first();
                                                    if ($checkOldRegNum) {
                                                    return redirect()->back()->with('invalid', 'This students list already uploaded in this system');
                                                    }
                                                    
                                                    User::create([
                                                    'academicyear_id' => $request->acy[$key],
                                                    'programclass' => $request->class[$key],
                                                    'uploadlist_id' => $id,
                                                    'reg_num' => $request->reg_num[$key],
                                                    'fname' => $request->fname[$key],
                                                    'lname' => $request->lname[$key],
                                                    'entry_level' => $request->entry_type[$key],
                                                    'email' => $email, // Convert email to lowercase
                                                    'campus' => $request->campus[$key],
                                                    'password' => Hash::make('password'),
                                                    'role' => 'student',
                                                    'semester' => $request->semester[$key],
                                                    'gender' => $request->gender[$key],
                                                    ]);
                                                    
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

                                                } else
                                                {
                                                // if no reg_nums proceed.

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
                                                
                                                $reg_number = $program_code.'/'. $campus_code.'/'.$intake_year.'/'.$intake_month.'/';
                                               
                                                $counter=00;
                                                $email='@mchs.mw';
                                                $campus = $request->campus[0];
                                              
                                                // need to use firstOrCreate method
                                                $already = User::where('academicyear_id', $request->acy[0])
                                                ->where('campus',  $request->campus[0])
                                                ->where('programclass',  $request->class[0])
                                                ->where('semester',  $request->semester[0])
                                                ->get();
                                                $alreadyUploadedStudents = $already->count(); 
                                                
                                                if($already->isNotEmpty())
                                                {
                                                    foreach ($request->lname as $key => $lname) {
                                                        $alreadyUploadedStudents++; // Increment counter within the loop
                                                        $formatted_counter = str_pad($alreadyUploadedStudents, 2, '0', STR_PAD_LEFT); // Format counter with leading zeros
                                                        
                                                        $email = strtolower($program_code . $campus_code . $intake_year . $intake_month . $formatted_counter . '@mchs.mw');
                                                        $checked_email = User::where('email', $email)->first();
                                                        if (!empty($checked_email)) {
                                                        return redirect()->back()->with('invalid', 'This students list was already uploaded1');
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
                                                        'semester' => $request->semester[$key],
                                                        'gender' => $request->gender[$key],
                                                        ]);
                                                        }
                                                }
                                                else
                                                {
                
                foreach ($request->lname as $key => $lname) {
                $counter++; // Increment counter within the loop
                $formatted_counter = str_pad($counter, 2, '0', STR_PAD_LEFT); // Format counter with leading zeros
                
                $email = strtolower($program_code . $campus_code . $intake_year . $intake_month . $formatted_counter . '@mchs.mw');
                $checked_email = User::where('email', $email)->first();
                if (!empty($checked_email)) {
                return redirect()->back()->with('invalid', 'This students list was already uploaded2');
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
                
        }
                       
    }

    public function savedConfirmedStudents($id){

       
         // save data in db and retrieve it for final confirmation
         //$academic_yr = Academicyear::all();
         //$prog_class = Programclass::all();  
         $class_students = Admission::where('uploadlist_id', $id)->first(); // we have students list, student class, program, academiyear ..
        

         $data['students'] = User::where('programclass',$class_students->class)
         ->where('academicyear_id', $class_students->academicyear)
         ->where('uploadlist_id', $class_students->uploadlist_id)
         ->where('campus', $class_students->campus)->get();
         //$data['confirmedstudents'] = Student::where('academicyear_id', $request->acy[0])->where('programclass', $request->class[0])->get();
         //dd($data['students']);
         //dd($data['confirmedstudents']);
         $data['stu'] = User::where('programclass',$class_students->class)
         ->where('academicyear_id', $class_students->academicyear)->first();
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

    public function studentProfile()
    {
        return view('admin.student.student_profile');
    }

    public function storeStudentProfile(Request $request)
    {
        $validated = $request->validate([
            'title' =>'required',
            'initials' => '',
            'dbirth' => 'required|date',
            'gender' =>'required',
            'marital' =>'required',
            'country' =>'required',
            'religion' =>'required',
            'district' =>'required',
            'traditional' =>'required',
            'village' =>'required',
            'student_phone1' =>'required',
            'student_phone2' =>'required',
            'student_email' =>'required|email',
            'student_address' =>'required',
            'kin_fullname' =>'required',
            'relationship' =>'required',
            'kin_phone' =>'required',
            'kin_email' =>'required|email',
            'kin_address' =>'required',
        ]);

        if(!empty($validated))
        {
            $studentprofile = Studentprofile::create([
                'title' => $request->title,
                'initials' => $request->initials,
                'dbirth' => $request->dbirth,
                'gender' => $request->gender,
                'marital' => $request->marital,
                'country' =>$request->country,
                'religion' =>$request->religion,
                'district' =>$request->district,
                'traditional' =>$request->traditional,
                'village' =>$request->village,
                'student_phone1' =>$request->student_phone1,
                'student_phone2' =>$request->student_phone2,
                'student_email' =>$request->student_email,
                'student_address' =>$request->student_address,
                'kin_fullname' =>$request->kin_fullname,
                'relationship' =>$request->relationship,
                'kin_phone' =>$request->kin_phone,
                'kin_email' =>$request->kin_email,
                'kin_address' =>$request->kin_address,
                'user_id' => Auth::user()->id,
            ]);

             if($studentprofile)  
             {
                return redirect()->back()->with('status', 'Profile updated successfully');
             }
        };

    }

    public function editPassword()
    {
        return view('admin.student.resetStudentPassword');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'old_password' => 'required|min:6|max:100',
            'new_password' => 'required|min:6|max:100',
            'confirm_password' => 'required|same:new_password',
        ]);

        $currentUser = Auth::user();
        if(Hash::check($request->old_password, $currentUser->password))
        {
             $user = User::where('id', $currentUser->id)->update(['password' => Hash::make($request->new_password)]);
             if($user)
             {
                return redirect()->back()->with('status', 'Password updated successfully');
             }
        }
        else
        {
            return redirect()->back()->with('invalid', 'Password does not match');
        }
    } // end function

    public function allStudentsList()
    {
        $students = User::where('role', 'student')->get();
        return view('admin.users.all_students', compact('students'));
    } //end function

    public function studentChangePassword($id)
    {   
        $student = User::find($id);
        if($student)
        {
            return view('admin.users.student_change_password', compact('student'));
        }
       
    } // end function 

    public function adminUpdateStudentPassword(Request $request, $id)
    {
        //dd($request->all(), $id);
        $validated = request()->validate([
            'new_password' => 'required|min:6|max:100',
            'confirm_password' => 'required|same:new_password',
        ]);

        

        $student = User::find($id);
        if($student)
        {
            $student->update([
                'password' => Hash::make($request->new_password)
            ]);
        }
        return redirect()->back()->with('status', 'Password updated successfully');
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

