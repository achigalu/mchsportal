<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\courseApplication;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\GD\Driver;
use Illuminate\Support\Facades\Auth;
use App\Models\Program;
use ZipArchive;

class ApplicantController extends Controller
{
    public function applicantPostForm1(Request $request)
    {
        // Store the values in the session
        session()->put([
            'fname' => $request->input('fname'),
            'initials' => $request->input('initials'),
            'lname' => $request->input('lname'),
            'sex' => $request->input('sex'),
            'age' => $request->input('age'),
            'dbirth' => $request->input('dbirth'),
            'marital' => $request->input('marital'),
            'district' => $request->input('district'),
            'traditional' => $request->input('traditional'),
            'village' => $request->input('village'),
            'student_phone1' => $request->input('student_phone1'),
            'student_phone2' => $request->input('student_phone2'),
            'student_email' => $request->input('student_email'),
            'student_address' => $request->input('student_address'),
            'kin_fullname' => $request->input('kin_fullname'),
            'relationship' => $request->input('relationship'),
            'kin_phone' => $request->input('kin_phone'),
            'kin_email' => $request->input('kin_email'),
            'kin_address' => $request->input('kin_address'),
            'kin_occupation' => $request->input('kin_occupation'),
        ]);
                
        // process form 1 here
        return redirect()->route('applicant.get.form2');
    }

    public function applicantGetForm2()
    {
        return view('admin.applicant.applicant_form2');
    }

    public function applicantPostForm2(Request $request)
    {
        // process form 2 here
        // do something with the data
        session()->put([
            'qualification' => $request->input('qualification'),
            'certificate_no' => $request->input('certificate_no'),
            'msce_year' => $request->input('msce_year'),
            'school_attended' => $request->input('school_attended'),
            'school_address' => $request->input('school_address'),
            'english_grade' => $request->input('english_grade'),
            'maths_grade' => $request->input('maths_grade'),
            'biology_grade' => $request->input('biology_grade'),
            'pscience_grade' => $request->input('pscience_grade'),
            'physics_grade' => $request->input('physics_grade'),
            'chemistry_grade' => $request->input('chemistry_grade'),
            'agriculture_grade' => $request->input('agriculture_grade'),
            'geography_grade' => $request->input('geography_grade'),
            'chichewa_grade' => $request->input('chichewa_grade'),
            'history_grade' => $request->input('history_grade'),
            'bk_grade' => $request->input('bk_grade'),
            'computer_grade' => $request->input('computer_grade'),
            'admath_grade' => $request->input('admath_grade'),

            'gs_grade' => $request->input('gs_grade'),
            'home_grade' => $request->input('home_grade'),
            'social_grade' => $request->input('social_grade'),
            'lifes_grade' => $request->input('lifes_grade'),
            'bs_grade' => $request->input('bs_grade'),

            'other_subjects' => $request->input('other_subjects'),
            'aggregate_grade' => $request->input('aggregate_grade'),
            'pcertificate' => $request->input('pcertificate'),
            'pyear' => $request->input('pyear'),
            'pcollege' => $request->input('pcollege'),
            'occupation' => $request->input('occupation'),
            'employer' => $request->input('employer'),
            'workplace' => $request->input('workplace'),
            'choice1_program_id' => $request->input('choice1_program_id'),
            'choice2_program_id' => $request->input('choice2_program_id'),
            'choice3_program_id' => $request->input('choice3_program_id'),
            'parent_guardian' => $request->input('parent_guardian'),
            'fee_sponsor' => $request->input('fee_sponsor'),
            'fee_other' => $request->input('fee_other'),
        ]);
       
        return redirect()->route('applicant.get.form3');
    }

    public function applicantGetForm3()
    {
        return view('admin.applicant.applicant_form3');
    }


    public function applicantPostForm3(Request $request)
{
    // Validate the incoming request for file uploads
    $validated = $request->validate([
        'cv' => 'nullable|mimes:jpeg,png,jpg,gif,svg,doc,docx,pdf|max:2048',
        'msce_copy' => 'nullable|mimes:jpeg,png,jpg,gif,svg,doc,docx,pdf|max:2048',
        'bank_slip' => 'nullable|mimes:jpeg,png,jpg,gif,svg,doc,docx,pdf|max:2048',
        'copy_pcertificate' => 'nullable|mimes:jpeg,png,jpg,gif,svg,doc,docx,pdf|max:2048',
        'copy_id' => 'nullable|mimes:jpeg,png,jpg,gif,svg,doc,docx,pdf|max:2048',
        'pregistration' => 'nullable|mimes:jpeg,png,jpg,gif,svg,doc,docx,pdf|max:2048',
        'remove_files' => 'nullable|array', // For checkbox removal
        'remove_files.*' => 'nullable|string' // Field names to remove
    ]);

    // Directory where uploaded files will be stored
    $dir = 'uploads/applicants_photos';

    // Ensure the directory exists
    if (!file_exists(public_path($dir))) {
        mkdir(public_path($dir), 0777, true);
    }

    // Handle file removals first (from checkboxes or similar)
    if ($request->has('remove_files')) {
        foreach ($request->input('remove_files') as $fieldToRemove) {
            // Delete the physical file if it exists
            if (session($fieldToRemove) && file_exists(public_path(session($fieldToRemove)))) {
                unlink(public_path(session($fieldToRemove)));
            }
            // Remove from session
            session()->forget($fieldToRemove);
        }
    }

    // Define the fields for which files will be uploaded
    $imageFields = [
        'cv',
        'msce_copy',
        'bank_slip',
        'copy_pcertificate',
        'copy_id',
        'pregistration',
    ];

    foreach ($imageFields as $field) {
        // Handle file upload
        if ($request->hasFile($field) && $request->file($field)->isValid()) {
            // Delete old file if exists
            if (session($field) && file_exists(public_path(session($field)))) {
                unlink(public_path(session($field)));
            }

            $image = $request->file($field);
            $fname = session('fname');
            $lname = session('lname');

            $imageName = $fname.'_'.$lname.'_'.$field.'_'.time().uniqid('_', true).'.'.$image->getClientOriginalExtension();
            $image->move(public_path($dir), $imageName);

            // Update session with new file path
            session([$field => $dir.'/'.$imageName]);
        }
        // Note: No else clause - we don't modify session if no file is uploaded
    }

    return view('admin.applicant.form_review');
}
 
    public function applicantSubmitted()
    {
        return view('admin.applicant.applicant_submitted');
    }

    public function onlineApplicationSummary()
    {
        $allprograms = courseApplication::all();
        $data['programcount'] = $allprograms->count();

        return view('admin.applicant.online_app_summary', $data);
    }

    public function onlineApplicationsProgramList($id)
    {
        $data['allapplications'] = courseApplication::where('choice1_program_id', $id)->get();
        $data['appCount'] = $data['allapplications']->count();
        $data['program_id'] = $id;
        $data['program'] = Program::find($id);
        return view('admin.applicant.online_app_program_list', $data);
    }

    public function zippedApplicantFiles($applicantId)
    {
        $applicant = courseApplication::findOrFail($applicantId);
    
        // Define the files with their display names
        $files = [
            'CV' => $applicant->cv,
            'MSCE_Certificate' => $applicant->msce_copy,
            'Bank_Slip' => $applicant->bank_slip,
            'Professional_Certificate' => $applicant->copy_pcertificate,
            'ID_Copy' => $applicant->copy_id,
            'Registration_Proof' => $applicant->pregistration,
        ];
    
        $zipFileName = $applicant->fname . $applicant->lname.'_application_files'.'.zip';
        $zipFilePath = storage_path('app/public/temp/' . $zipFileName);
        
        // Create temp directory if it doesn't exist
        if (!file_exists(storage_path('app/public/temp'))) {
            mkdir(storage_path('app/public/temp'), 0755, true);
        }
    
        $zip = new ZipArchive;
        $filesAdded = false;
    
        if ($zip->open($zipFilePath, ZipArchive::CREATE) === TRUE) {
            foreach ($files as $displayName => $filePath) {
                if ($filePath && file_exists(public_path($filePath))) {
                    $extension = pathinfo($filePath, PATHINFO_EXTENSION);
                    $zip->addFile(
                        public_path($filePath), 
                        $displayName . '.' . $extension
                    );
                    $filesAdded = true;
                }
            }
            
            $zip->close();
    
            if ($filesAdded) {
                return response()->download($zipFilePath)
                    ->deleteFileAfterSend(true);
            } else {
                return redirect()->back()->with('invalid','No files attached for '. $applicant->fname .' '. $applicant->lname . ' for this application');
            }
        } else {
            return response()->json([
                'error' => 'Failed to create ZIP file'
            ], 500);
        }
    }


    public function deleteFile(Request $request)
        {
    $field = $request->input('field');
    $validFields = ['msce_copy', 'cv', 'bank_slip', 'copy_pcertificate', 'copy_id', 'pregistration'];

    if (!in_array($field, $validFields)) {
        return response()->json(['success' => false, 'message' => 'Invalid field']);
    }

    // Delete the physical file
    if (session($field) && file_exists(public_path(session($field)))) {
        unlink(public_path(session($field)));
    }

    // Remove from session
    session()->forget($field);

    return response()->json(['success' => true]);
}



    public function reviewedFormData()
    {
        // Create the application record
            $already = courseApplication::where('user_id', Auth::id())->first();
            $refNO = Program::find(session('choice1_program_id'));
            $applicants = courseApplication::where('choice1_program_id', session('choice1_program_id'))->count();
        
                        $aggregategrade = [
                            'english_grade' => session('english_grade'),
                            'maths_grade' => session('maths_grade'),
                            'biology_grade' => session('biology_grade'),
                            'pscience_grade' => session('pscience_grade'),
                            'physics_grade' => session('physics_grade'),
                            'chemistry_grade' => session('chemistry_grade'),
                            'agriculture_grade' => session('agriculture_grade'),
                            'geography_grade' => session('geography_grade'),
                            'chichewa_grade' => session('chichewa_grade'),
                            'history_grade' => session('history_grade'),
                            'bk_grade' => session('bk_grade'),
                            'computer_grade' => session('computer_grade'),
                            'admath_grade' => session('admath_grade'),
                            'gs_grade' => session('gs_grade'),
                            'home_grade' => session('home_grade'),
                            'social_grade' => session('social_grade'),
                            'lifes_grade' => session('lifes_grade'),
                            'bs_grade' => session('bs_grade'),
                        ];

                        // Ensure no null grades remain
                        $aggregategrade = array_filter($aggregategrade, fn($grade) => $grade !== null);

                        // Check if English grade exists
                        if (!isset($aggregategrade['english_grade'])) {
                            return response()->json(['error' => 'English grade is required.'], 400);
                        }

                        $englishGrade = $aggregategrade['english_grade'];
                        unset($aggregategrade['english_grade']);

                        // Check if there are at least 5 other grades
                        if (count($aggregategrade) < 5) {
                            $aggregate = 'N/A';
                        } else {
                            asort($aggregategrade);
                            $top5 = array_slice($aggregategrade, 0, 5);
                            $aggregate = $englishGrade + array_sum($top5);
                        }

            if ($already) {
                return redirect()->route('applicant.submitted');
                         }
            $submitted = courseApplication::create([
                'user_id' => Auth::id(),
                'referenceno' => $refNO->program_code.'/000'.$applicants + 1,
                'fname' => session('fname'),
                'initials' => session('initials'),
                'lname' => session('lname'),
                'sex' => session('sex'),
                'age' => session('age'),
                'dbirth' => session('dbirth'),
                'marital' => session('marital'),
                'district' => session('district'),
                'traditional' => session('traditional'),
                'village' => session('village'),
                'student_phone1' => session('student_phone1'),
                'student_phone2' => session('student_phone2'),
                'student_email' => session('student_email'),
                'student_address' => session('student_address'),
                'kin_fullname' => session('kin_fullname'),
                'relationship' => session('relationship'),
                'kin_phone' => session('kin_phone'),
                'kin_email' => session('kin_email'),
                'kin_address' => session('kin_address'),
                'kin_occupation' => session('kin_occupation'),
                'qualification' => session('qualification'),
                'certificate_no' => session('certificate_no'),
                'msce_year' => session('msce_year'),
                'school_attended' => session('school_attended'),
                'school_address' => session('school_address'),
                'english_grade' => session('english_grade'),
                'maths_grade' => session('maths_grade'),
                'biology_grade' => session('biology_grade'),
                'pscience_grade' => session('pscience_grade'),
                'physics_grade' => session('physics_grade'),
                'chemistry_grade' => session('chemistry_grade'),
                'agriculture_grade' => session('agriculture_grade'),
                'geography_grade' => session('geography_grade'),
                'chichewa_grade' => session('chichewa_grade'),
                'history_grade' => session('history_grade'),
                'bk_grade' => session('bk_grade'),
                'computer_grade' => session('computer_grade'),
                'admath_grade' => session('admath_grade'),
                'gs_grade' => session('gs_grade'),
                'home_grade' => session('home_grade'),
                'social_grade' => session('social_grade'),
                'lifes_grade' => session('lifes_grade'),
                'bs_grade' => session('bs_grade'),
                'other_subjects' => session('other_subjects'),
                //'aggregate_grade' => session('aggregate_grade'),
                'aggregate_grade' => $aggregate,
                'pcertificate' => session('pcertificate'),
                'pyear' => session('pyear'),
                'pcollege' => session('pcollege'),
                'occupation' => session('occupation'),
                'employer' => session('employer'),
                'workplace' => session('workplace'),
                'choice1_program_id' => session('choice1_program_id'),
                'choice2_program_id' => session('choice2_program_id'),
                'choice3_program_id' => session('choice3_program_id'),
                'parent_guardian' => session('parent_guardian'),
                'fee_sponsor' => session('fee_sponsor'),
                'fee_other' => session('fee_other'),
                'cv' => session('cv') ?? null,
                'msce_copy' => session('msce_copy') ?? null,
                'bank_slip' => session('bank_slip') ?? null,
                'copy_pcertificate' => session('copy_pcertificate') ?? null,
                'copy_id' => session('copy_id') ?? null,
                'pregistration' => session('pregistration') ?? null,
            ]);
    
            if ($submitted) {
                session()->forget([
                    'fname', 'initials', 'lname', 'sex', 'age', 'dbirth', 'marital', 'district', 'traditional',
                    'village', 'student_phone1', 'student_phone2', 'student_email', 'student_address', 'kin_fullname',
                    'relationship', 'kin_phone', 'kin_email', 'kin_address', 'kin_occupation', 'qualification', 
                    'certificate_no', 'msce_year', 'school_attended', 'school_address', 'english_grade', 'maths_grade',
                    'biology_grade', 'pscience_grade', 'physics_grade', 'chemistry_grade', 'agriculture_grade', 
                    'geography_grade', 'chichewa_grade', 'history_grade', 'bk_grade', 'computer_grade', 'admath_grade', 
                    'other_subjects', 'aggregate_grade', 'pcertificate', 'pyear', 'pcollege', 'occupation', 'employer',
                    'workplace', 'choice1_program_id', 'choice2_program_id', 'choice3_program_id', 'parent_guardian',
                    'fee_sponsor', 'fee_other', 'cv', 'msce_copy', 'bank_slip', 'copy_pcertificate', 'copy_id', 'pregistration'
                ]);
                
                return redirect()->route('applicant.submitted');
            } else {
                return redirect()->route('applicant.get.form3')->with('invalid','Something went wrong, you can try again..');
            }
        }    
    }

