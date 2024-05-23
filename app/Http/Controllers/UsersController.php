<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UsersController extends Controller
{

    public function index(){
        return redirect(route('login'));
        //return view('auth.login');
    }

    public function loggedInUsers(){
       
        $role = Auth::user()->role;
    
        if(!empty($role))
        {
            if($role == 'student')
            {
                return redirect(route('student.dashboard'));
            }
            
            elseif($role == 'applicant')
           {
                return redirect(route('applicant.dashboard'));
           }
           else
           {
                return redirect(route('admin.dashboard'));
           }
                
        }
        else
        {
            return view('auth.login');
        }
       
    }
    // Logged in Students here

    public function loggedInStudent()
    {
        return view('admin.student.dashboard');
    }

    // Logged in admin here

    public function loggedInAdmin()
    {
        return view('admin.layout.index');
    }

    public function applicantAdmin()
    {
        return view('admin.applicant.index');  
    }



    public function listUsers(){
        return view('admin.users.view_users');
    }

    public function createUsers(){
        return view('admin.users.add_user');  
    }

    public function storeUsers(Request $request){
     
        $validated = $request->validate([
            'fname' => 'required|max:50',
            'lname' => 'required|max:50',
            'gender' => 'required',
            'email' => 'required|email|max:50',
            'role' => 'required',
            'department'=>'required',
            'campus_id' => 'required',
            'password'  => 'required|between:8,255|confirmed',
            'password_confirmation' => 'required'
        ]);
                    //$request->validate([
                     //   'name' => ['required', 'string', 'max:255'],
                    //    'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
                    //    'password' => ['required', 'confirmed', Rules\Password::defaults()],
                   // ]);

        if($validated){
            $user = new User;
         

        }
    }

    public function Logout( Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
