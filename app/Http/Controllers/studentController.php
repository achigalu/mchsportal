<?php

namespace App\Http\Controllers;

use App\Models\lecturerSubjects;
use App\Models\Studentsubject;
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
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Studentprofile;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\GD\Driver;
use App\Models\Myclasssubject;
use Intervention\Image\ImageManagerStatic as Image;

class studentController extends Controller
{
    public function addStudent(){
        return view('admin.intake.add_student');
    }

     public function uploadStudent(){
         $data['academicy'] = Academicyear::all();
         return view('admin.intake.upload_student', $data); 
     }

    // public function uploadOldStudents()
    // {
    //     $data['academicy'] = Academicyear::all();
    //     return view('admin.intake.upload_old_student', $data);
    // }
    // public function uploadingOldStudents(Request $request)
    // {
    //     $validated = $request->validate([
    //         'students_upload' => 'required|file|mimes:csv,xls,xlsx|max:2048',
    //         'academic_yr_id' => 'required',
    //         'program_id' =>'required',
    //         'intake_name' => 'required',
    //      ]);
    //      $programCampus = Program::where('id', $request->program_id)->first();


    //      dd($request->all(), $programCampus->campus_id);
    // }



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
      $already = Uploadlist::where('academic_yr_id', $request->academic_yr_id)
      ->where('intake_month',$formatedmonth)
      ->where('campus',$request->campus)
      ->where('upload_name',$request->intake_name)
      ->first();

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

            if ($upload = Uploadlist::where('academic_yr_id', $request->academic_yr_id)
            ->where('campus', $request->campus)
            ->where('intake_month',$formatedmonth)
            ->where('upload_name', $request->intake_name)
            ->first()) 
            {
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
        
                    $checkedReferenceCode = Admission::where('uploadlist_id', $id)->first();
                    if($checkedReferenceCode)
                    {
                        return redirect(route('confirm.students.lists', $id));
                        
                    }else{
                        return redirect(route('confirm.students.lists', $id))->with('invalid', 'Reference or Registration numbers already exist in the system.');
                    }
                   
            }
          
           }

       /// here we call blade file to validate the data and store it in another table (student table)
       
        return redirect()->back()->with('invalid', 'Something unknown to us went wrong');  
           
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
        $data['admissions'] = Admission::where('academicyear', $ayear_id)
        ->where('uploadlist_id', $upload_id)->orderBy('lname', 'asc')
        ->get();

        return view('admin.intake.confirmStudentsList', $data);
    }

    // same as above function only different views

    //List of students to be uploaded in Users table.

    public function confirmStudentsLists($id) // upload_list id.

        {
        $admissions = Uploadlist::find($id);
        if(!empty($admissions))
        {
            if($admissions->processed==1)
            {   $class_students = Admission::where('uploadlist_id', $id)->first();
                $data['title'] = 'Uploaded Class List';
                $data['uploadedStudents'] = User::where('uploadlist_id' , $id)->get();
                $data['stu'] = User::where('programclass',$class_students->class)
                ->where('academicyear_id', $class_students->academicyear)
                ->first();
                $data['upload_id'] = $id;
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
                $data['admissions'] = Admission::where('academicyear', $data['ayear_id'])
                ->where('uploadlist_id', $upload_id)->orderBy('lname', 'asc')
                ->get();
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
       
        $uploadlist = Uploadlist::find($id);
        $wrongAd = Admission::where('uploadlist_id', $id)->get();
        if($wrongAd->isNotEmpty())
        {
            foreach($wrongAd as $ad)
            {
                $ad->delete();
            }

            $uploadlist->delete();
        }
        return redirect(route('upload.students'))->with('status', 'Upload List Discarded Successfully');

    }

    public function saveConfirmedStudents(Request $request, $id) // $id == upload-list id
    {
        set_time_limit(180); // Allow the script to run for 120 seconds
        switch($request->input('action')) 
        {
            
                case 'discardlist':
                    return redirect()->route('discard.upload.lists', $id);
                    break;
                    case 'back':
                        return redirect()->route('admission.student');
                        break;

                            case 'savelist':

                        $inAdmission = Admission::where('uploadlist_id', $id)->first();
                               
                                // check if some students are already uploaded - count to add extra
                                // check if 
                         $class = Programclass::where('classcode' , $inAdmission->class)
                         ->first();
                            
                         if (!$class)
                                {
                                    return redirect()->route('confirm.students.lists', $id)->with('invalid', 'The specified class is not defined in this system.');
                                }
                              
                         else{ 
                                // more logic for validating reg numbers...    
                               // $data['reference_code'] = Admission::where('reference_code', )->where('uploadlist_id', $upload_id)->orderBy('lname', 'asc') ->get();   
                               // program code like CCM

                                $thisClassAdmissions = Admission::where('uploadlist_id', $id)->get();
                                
                            // GENERAL LOGIC TO DETERMINE THE PROGRAM FOR NEW AND OLD STUDENTS IN ADIMISSION TABLE
                                if ($thisClassAdmissions->isNotEmpty()) {
                                    $firstStudent = $thisClassAdmissions->first();
                                    $thisClassAdmissionsClass = $firstStudent->class;
                                    $thisClassAdmissionsCampus = $firstStudent->campus;
                                    if($thisClassAdmissionsCampus=="Lilongwe")
                                    {
                                        $thisClassAdmissionsCampus=1;
                                    }
                                    elseif($thisClassAdmissionsCampus=="Blantyre")
                                    {
                                        $thisClassAdmissionsCampus=2;
                                    }
                                    else
                                    {
                                        $thisClassAdmissionsCampus=3;
                                    }

                                    $classID = Programclass::where('classcode', $thisClassAdmissionsClass)
                                    ->where('campus_id', $thisClassAdmissionsCampus)->first();

                                     
                                    if (!$classID) {
                                        return redirect()->route('confirm.students.lists', $id)->with('invalid', 'The specified class is not properlydefined in this system - check the class code or campus.');
                                    }

                                   $programID = $classID->program->id;
                                     // Replace 'attribute_name' with the actual attribute you want to access
                                    // Do something with $attribute
                                }

                                // Check if any of the old students have a non-empty reg_num

                                                $hasRegNum = $thisClassAdmissions->pluck('reg_num')->filter()->isNotEmpty();

                                                if ($hasRegNum) {
                                                // There are students with non-empty reg_num values
                                                foreach ($thisClassAdmissions as $oldStu) {
                                                   
                                                    $reg_num = $oldStu->reg_num;
                                                    $formatted_reg_num = str_replace('/', '', $reg_num);
                                                    $formatted_reg_num = strtolower($formatted_reg_num);
                                                   // echo $formatted_reg_num;  // Output: dcmll20240803

                                                    $email = $formatted_reg_num.'@mchs.mw';
                                                    $checkOldRegNum = User::where('reg_num', $oldStu->reg_num)->first();
                                                    if ($checkOldRegNum) {
                                                    return redirect()->back()->with('invalid', 'This students list already uploaded in this portal');
                                                    }
                                                    // Continuing or graduated students with regNums already in place
                                                    $studentsAdded = User::create([
                                                    'academicyear_id' => $oldStu->academicyear,
                                                    'programclass' => $oldStu->class,
                                                    'uploadlist_id' => $id,
                                                    'reg_num' => $oldStu->reg_num,
                                                    'fname' => $oldStu->fname,
                                                    'dob' => $oldStu->dob,
                                                    'initials' => $oldStu->initials,
                                                    'lname' => $oldStu->lname,
                                                    'entry_level' => $oldStu->entry_level,
                                                    'email' => $email, // Convert email to lowercase
                                                    'campus_id' => $thisClassAdmissionsCampus,
                                                    'campus' => $oldStu->campus,
                                                    'program_id' => $programID,
                                                    'password' => Hash::make('password'),
                                                    'role' => $oldStu->role,
                                                    'semester' => $oldStu->semester,
                                                    'gender' => $oldStu->gender,
                                                    
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
                                               // $program_id = $class->program_id;

                                                $uploadStudents = Admission::where('academicyear', $request->acy[0])
                                                ->where('uploadlist_id', $id)
                                                ->where('campus',  $request->campus[0])
                                                ->get();
                
                                                if ($uploadStudents->isNotEmpty()) {
                                                    $firstStudent = $uploadStudents->first();
                                                    $uploadStudentsClass = $firstStudent->class;
                                                    $uploadStudentsCampus = $firstStudent->campus;
                                                    if($uploadStudentsCampus=="Lilongwe")
                                                    {
                                                        $uploadStudentsCampus=1;
                                                    }
                                                    elseif($uploadStudentsCampus=="Blantyre")
                                                    {
                                                        $uploadStudentsCampus=2;
                                                    }
                                                    else
                                                    {
                                                        $uploadStudentsCampus=3;
                                                    }
                
                                                    $programID = Programclass::where('classcode', $uploadStudentsClass)
                                                    ->where('campus_id', $uploadStudentsCampus)->first();
                                                    //dd($programID->program_id);
                                                    $programID = $programID->program_id;
                                                }

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
                                                        return redirect()->back()->with('invalid', 'This students list was already uploaded in this mchs system.');
                                                        }
                                                        // dd(
                                                        //     $request->acy[$key],
                                                        //     $request->class[$key],
                                                        //     $id,
                                                        //     $request->class[$key],
                                                        //     $reg_number . $formatted_counter,
                                                        //     $request->fname[$key],
                                                        //     $request->lname[$key],
                                                        //     $request->dob[$key],
                                                        //     $request->initials[$key],
                                                        //     $request->entry_type[$key],
                                                        //     $email,
                                                        //     $campus,
                                                        //     Hash::make(strtolower($request->dob[$key])),
                                                        //     $request->role[$key],
                                                        //     $programID,
                                                        //     $request->semester[$key],
                                                        //     $request->gender[$key],
                                                        // );

                                                             //Adding to the existing list of new students
                                                        $studentsAdded = User::create([
                                                        'academicyear_id' => $request->acy[$key],
                                                        'programclass' => $request->class[$key],
                                                        'uploadlist_id' => $id,
                                                        'reg_num' => $reg_number . $formatted_counter,
                                                        'fname' => $request->fname[$key],
                                                        'lname' => $request->lname[$key],
                                                        'dob' => $request->dob[$key],
                                                        'initials' => $request->initials[$key],
                                                        'entry_level' => $request->entry_type[$key],
                                                        'email' => $email, // Convert email to lowercase
                                                        'campus_id' => $uploadStudentsCampus,
                                                        'campus' => $campus,
                                                        'password' => Hash::make(strtolower('password')),
                                                        'role' => $request->role[$key],
                                                        'program_id' => $programID,
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
                                                }
                                                else
                                                {
                
                foreach ($request->lname as $key => $lname) {
                $counter++; // Increment counter within the loop
                $formatted_counter = str_pad($counter, 2, '0', STR_PAD_LEFT); // Format counter with leading zeros
                
                $email = strtolower($program_code . $campus_code . $intake_year . $intake_month . $formatted_counter . '@mchs.mw');
                $checked_email = User::where('email', $email)->first();
                if (!empty($checked_email)) {
                return redirect()->back()->with('invalid', 'This students list was already uploaded in this system');
                }
                // new students and assigned regNumbers from 1
                User::create([
                'academicyear_id' => $request->acy[$key],
                'programclass' => $request->class[$key],
                'uploadlist_id' => $id,
                'reg_num' => $reg_number . $formatted_counter,
                'fname' => $request->fname[$key],
                'lname' => $request->lname[$key],
                'dob' => $request->dob[$key],
                'initials' => $request->initials[$key],
                'entry_level' => $request->entry_type[$key],
                'email' => $email, // Convert email to lowercase
                'campus_id' => $uploadStudentsCampus,
                'campus' => $campus,
                'password' => Hash::make(strtolower('password')),
                'program_id' => $programID,
                'role' => $request->role[$key],
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
                $userList = User::where('uploadlist_id' , $id)->delete();
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
            'title' => 'required',
            'initials' => 'nullable|string',
            'dbirth' => 'required|date',
            'gender' =>'required',
            'marital' =>'required',
            'country' =>'required',
            'religion' =>'required',
            'district' =>'required',
            'traditional' =>'required',
            'village' =>'required',
            'student_phone1' =>'nullable',
            'student_phone2' =>'nullable',
            'student_email' =>'nullable|email',
            'student_address' =>'required',
            'kin_fullname' =>'required',
            'relationship' =>'required',
            'kin_phone' =>'nullable',
            'kin_email' =>'nullable|email',
            'kin_address' =>'nullable',
            'student_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $dir = 'uploads/students_photo';
        if (!file_exists(public_path($dir))) {
            mkdir(public_path($dir), 0777, true);
        }
    
        $imageFields = [
            'student_photo',
        ];
    
        $imageName = null;
    
        // Handle image file upload
        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                // Get the file from the request
                $image = $request->file($field);
    
                // Generate a unique filename
                $imageName = time() . uniqid('_', true) . '.' . $image->getClientOriginalExtension();
    
                // Move the image to the desired directory
                $image->move(public_path($dir), $imageName);
            }
        }
    
        // Insert the validated data into the database
        if (!empty($validated)) {
            $studentprofile = Studentprofile::create([
                'title' => $request->title,
                'initials' => $request->initials,
                'dbirth' => $request->dbirth,
                'gender' => $request->gender,
                'marital' => $request->marital,
                'country' => $request->country,
                'religion' => $request->religion,
                'district' => $request->district,
                'traditional' => $request->traditional,
                'village' => $request->village,
                'student_phone1' => $request->student_phone1,
                'student_phone2' => $request->student_phone2,
                'student_email' => $request->student_email,
                'student_address' => $request->student_address,
                'kin_fullname' => $request->kin_fullname,
                'relationship' => $request->relationship,
                'kin_phone' => $request->kin_phone,
                'kin_email' => $request->kin_email,
                'kin_address' => $request->kin_address,
                'photo' => $imageName,  // Save the image filename
                'user_id' => Auth::user()->id,
            ]);
    
            if ($studentprofile) {
                return redirect(route('myhome'))->with('status', 'Profile created successfully');
            } else {
                return redirect()->route('myhome')->with('invalid', 'Failed to create profile');
            }
        }
    }

    public function editStudentProfile($id)
    {
        $auth_user = Studentprofile::where('user_id', $id)->first(); 
        $user = User::findOrfail($id);

        $data = [
            'stuProfile' => $auth_user,
            'stu' => $user
        ];

        return view('admin.student.edit_student_profile', $data);
    }

    public function updateStudentProfile(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' =>'required',
                'student_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'initials' => 'nullable|string',
                'dbirth' => 'required|date',
                'gender' =>'required',
                'marital' =>'required',
                'country' =>'required',
                'religion' =>'required',
                'district' =>'required',
                'traditional' =>'required',
                'village' =>'required',
                'student_phone1' =>'required',
                'student_phone2' =>'nullable',
                'student_email' =>'required|email',
                'student_address' =>'required',
                'kin_fullname' =>'required',
                'relationship' =>'required',
                'kin_phone' =>'required',
                'kin_email' =>'required|email',
                'kin_address' =>'required',
            ]);
    
        } catch (\Illuminate\Validation\ValidationException $e) {
            dd($e->errors()); // Debug validation errors
        }

        $profileID = Auth::user()->id;
        $userProfile = Studentprofile::where('user_id', $profileID)->first();
    
        if (!empty($userProfile)) {
            $dir = 'uploads/students_photo';
            if (!file_exists(public_path($dir))) {
                mkdir(public_path($dir), 0777, true);
            }
    
            $imageFields = ['student_photo'];
            $imageName = $userProfile->photo ?? 'students_photo/3.jpg'; // Default image path
    
            foreach ($imageFields as $field) {
                if ($request->file($field)) {
                    $manager = new ImageManager(new Driver());
            
                    // Delete old photo if it exists and is not the default
                    if (!empty($userProfile->photo) && file_exists(public_path($userProfile->photo))) {
                        unlink(public_path($userProfile->photo));
                    }
            
                    // Generate a unique filename
                    $imageName = time() . uniqid('_', true) . '.' . $request->file($field)->getClientOriginalExtension();
                    $imagePath = $dir . '/' . $imageName; // Ensure correct path
            
                    // Process and save the image
                    $image = $manager->read($request->file($field));
                    $image->toJpeg(80)->save(public_path($imagePath));
            
                    // Debugging check
                    if (!file_exists(public_path($imagePath))) {
                        dd('Image not saved:', public_path($imagePath));
                    }
                }
            }
            // Update student profile
            $studentprofile = $userProfile->update([
                'title' => $request->title,
                'initials' => $request->initials,
                'photo' => $imageName, // Always has a value (uploaded image or default)
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
                'user_id' => $profileID,
            ]);

            if ($studentprofile) {
                return redirect()->back()->with('status', 'Profile updated successfully');
            } else {
                return redirect(route('myhome'))->with('invalid', 'Failed to create profile');
            }
        }
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

    public function editStudent($studentid)
     {
        $student = User::findOrfail($studentid);
        if(!empty($student))
        {
            return view('admin.users.edit_student', compact('student'));
        }
     }

     public function updateStudentDetails(Request $request, $stuID)
        {
            $validated = $request->validate([
                'fname' => 'required',
                'initials' => 'nullable',
                'lname' => 'required',
                'reg_num' => 'required',
                'phone' => 'nullable',
                'email' => 'nullable',
                'gender' => 'nullable',
                'dbirth' => 'nullable'
            ]);

            if($validated)
            {
                if($stuID)
                {
                    $student = User::findOrfail($stuID);
                    $stuinfo = User::where('id',$stuID)->where('reg_num',$request->reg_num)->first();
                    $already = User::where('reg_num', $request->reg_num)->first();
                    
                    if($stuinfo)
                    {
                        $student->update([
                            'fname' => $request->fname,
                            'initials' => $request->initials,
                            'lname' => $request->lname,
                            'gender' =>$request->gender,
                            'phone' => $request->phone,
                            'email' => $request->email,
                            'dob' => $request->dbirth
                        ]);

                        return redirect()->back()->with([
                            'status' => $student->fname.' '.$student->lname.'\'s '.'personal details updated successfully1',
                            'student' => $student
    
                        ]);
                    }

                    elseif(empty($already))
                    {
                        $student->update([
                            'fname' => $request->fname,
                            'initials' => $request->initials,
                            'reg_num' => $request->reg_num,
                            'lname' => $request->lname,
                            'phone' => $request->phone,
                            'email' => $request->email,
                            'dob' => $request->dbirth
                        ]); 

                        return redirect()->back()->with([
                            'status' => $student->fname.' '.$student->lname.'\'s '.'personal details updated successfully2',
                            'student' => $student
    
                        ]);
                    }
                    else
                    {
                        return redirect()->back()->with([
                            'status' => 'Registration number'. ' '.$request->reg_num.' ' .'is for'.' '.$already->fname .' '.$already->lname,
                            'student' => $student
    
                        ]);
                    }
                    
                }

            }

        }

        public function studentInfo($id)
        {
          $student = User::findOrFail($id);
          $stuprofile = Studentprofile::where('user_id',$id)->first();
            return view('admin.student.students_info', compact('student', 'stuprofile'));
        }

        public function deleteSingleStudent($id)
        {

            try {
                $user = User::findOrFail($id); // Will throw an exception if not found
                $user->delete(); // Delete the user
        
                // Redirect back with a success message
                return redirect()->back()->with('status', 'User ' . $user->fname . ' ' . $user->lname . ' deleted successfully');
            } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                // Handle user not found case
                return redirect()->back()->with('error', 'User not found');
            } catch (\Exception $e) {
                // Handle other possible errors
                return redirect()->back()->with('error', 'An error occurred while deleting the user');
            }
        }


        public function singleStudentChangeClass(Request $request)
        {
            $validated = $request->validate([
                'class_id' => 'nullable',
                'semester_id' => 'nullable',
                'reason' => 'nullable'
            ]);
        
            if ($validated) {
                $class = $request->class_id;
                $semester = $request->semester_id;
                $reason = $request->reason;
                $stuID = $request->student_id;
        
                $stuToChange = User::findOrFail($stuID);
        
                $updateData = [];
        
                // Only update class if provided
                if ($class) {
                    $myclass = Programclass::findOrFail($class);
                    $updateData['programclass'] = $myclass->classcode; // Use classcode instead of ID
        
                    // Determine campus details based on class
                    $updateData['campus_id'] = $myclass->campus_id;
                    $updateData['campus'] = match ($myclass->campus_id) {
                        1 => 'Lilongwe',
                        2 => 'Blantyre',
                        3 => 'Zomba',
                        default => 'Unknown'
                    };
                }
        
                // Only update semester if provided
                if ($semester) {
                    $updateData['semester'] = $semester;
                }
        
                if (!empty($updateData)) {
                    $stuToChange->update($updateData);
                }
        
                return redirect()->route('student.info', ['id' => $stuID])
                    ->with('status', 'Student: ' . $stuToChange->fname . ' ' . $stuToChange->lname . ' changed to: ' . 
                        ($class ? $myclass->classcode : 'No Change') . ' | Semester ' . ($semester ?? 'No Change') . ' - ' . 
                        ($updateData['campus'] ?? 'No Change'));
            }
        
            return back()->with('error', 'Failed to change student class.');
        }

        
public function addClassModulesToSingleStudent($student_id)
        {
            $student = User::findOrFail($student_id);
            $data['singleStudent'] = $student;
            $data['class'] = $student->programclass;
            $data['semester'] = $student->semester;
            $data['ourclass'] = Programclass::where('classcode', $data['class'])->where('campus_id', $student->campus_id)->first();
            $data['class_program'] = $data['ourclass']->program_id;
            $data['class_code'] = $data['ourclass']->classcode;
            
            return view('admin.intake.attach_subjects_to_single_student', $data); 
        }

        
        public function allocateSubjectsToOneStudent($class, $semester, $campus, $student)
        {
            // Retrieve class information
            $classID = Programclass::find($class);
            if (!$classID) {
                return redirect()->back()->with('error', 'Class not found.');
            }
        
            // Retrieve subjects for the class and semester without an academic year
            $classSubjects = Myclasssubject::where('programclass_id', $class)
                ->where('semester', $semester)
                ->whereNull('academicyear_id')
                ->where('classcode', $classID->classcode)
                ->get();
        
            // Retrieve campus information
            $campus = Campus::find($campus);
            if (!$campus) {
                return redirect()->back()->with('invalid', 'Campus not found.');
            }
        
            // Retrieve the student
            $studentInstance = User::find($student);
            if (!$studentInstance || 
                $studentInstance->programclass != $classID->classcode || 
                $studentInstance->semester != $semester || 
                $studentInstance->campus_id != $campus->id) {
                return redirect()->back()->with('error', 'Student not found in the specified class, semester, and campus.');
            }
        
            // 1️⃣ Get the student's currently assigned subjects from Studentsubject
            $oldSubjects = Studentsubject::where('registration_no', $studentInstance->reg_num)
                ->where('semester', $semester)
                ->where('programclass_id', $class)
                ->where('academicyr_id', $studentInstance->academicyear_id)
                ->pluck('course_code')
                ->toArray();
        
            // 2️⃣ Get new subjects from Myclasssubject
            $newSubjects = $classSubjects->pluck('course.code')->toArray();
        
            // 3️⃣ Identify removed subjects (old ones that are NOT in the new ones)
            $removedSubjects = array_diff($oldSubjects, $newSubjects);
            if (!empty($removedSubjects)) {
                Studentsubject::where('registration_no', $studentInstance->reg_num)
                    ->where('semester', $semester)
                    ->where('programclass_id', $class)
                    ->where('academicyr_id', $studentInstance->academicyear_id)
                    ->whereIn('course_code', $removedSubjects)
                    ->delete();
        
                Log::info("Deleted subjects", [
                    'student' => $studentInstance->reg_num,
                    'removed_courses' => $removedSubjects
                ]);
            }
        
            // 4️⃣ Assign new subjects that are missing
            foreach ($classSubjects as $subject) {
                Studentsubject::firstOrCreate(
                    [
                        'academicyr_id' => $studentInstance->academicyear_id,
                        'programclass_id' => $class,
                        'semester' => $semester,
                        'campus_id' => $campus->id,
                        'registration_no' => $studentInstance->reg_num,
                        'course_code' => $subject->course->code,
                        'user_id' => $studentInstance->id,
                    ],
                    [
                        'assessment1' => null,
                        'assessment2' => null,
                        'exam_grade' => null,
                        'final_grade' => null,
                    ]
                );
            }
        
            return redirect(route('add.subject.to.students'))->with([
                'status' => "Subjects assigned to Student ({$studentInstance->reg_num}) in {$classID->classcode} | {$campus->campus} Campus, Semester: {$semester}.",
            ]);
        }
        
/// END OF MODIFIED VERSION......

   


































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

