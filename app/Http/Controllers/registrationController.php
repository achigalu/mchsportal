<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Program;

class registrationController extends Controller
{
   public function studentRegistration(Request $request)
   {
    $student = Auth::user();
    $user = User::findOrFail($student->id);
    {
        $user->update([
            'registered' => 1,
        ]);
    }
    return redirect()->route('student.dashboard');

   }

   public function studentsConfirmRegistration($id)
   {
    return view('admin.registration.students_confirmation1');
   }

   public function confirmCheckbox($class, $semester, $campus)
   {
    $students = User::where('programclass', $class)->where('semester', $semester)->where('campus', $campus)->where('registered',1)->get();
    return view('admin.registration.students_confirmation2', compact('students'));
   }

   public function confirmedStudents(Request $request)
   {
    // Get the IDs of the selected students
    $selectedStudentIds = $request->input('students', []);

    if (count($selectedStudentIds) > 0) {
        // Update the 'registered' field to 2 for each selected student
        User::whereIn('id', $selectedStudentIds)->update(['registered' => 2]);

        // Optionally, you can redirect with a success message
        return redirect()->route('students.confirm.registration',['id'=>Auth::user()->id])->with('success', 'Selected students have been successfully confirmed.');
    } else {
        // Handle case where no students were selected (e.g., show a warning message)
        return redirect()->route('students.confirm.registration',['id'=>Auth::user()->id])->with('error', 'No students were selected.');
    }
}
   
}
