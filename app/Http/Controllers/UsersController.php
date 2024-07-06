<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

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
           elseif($role == 'Executive Director')
           {
                return redirect(route('admin.dashboard'));
           }
           elseif($role == 'College Registrar')
           {
                return redirect(route('admin.dashboard'));
           }
           elseif($role == 'Dean')
           {
                return redirect(route('admin.dashboard'));
           }
           elseif($role == 'HOD')
           {
                return redirect(route('admin.dashboard'));
           }
           elseif($role == 'lecturer')
           {
                return redirect(route('admin.dashboard'));
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

    public function disableUser($id)
    {
        $user = User::find($id);
        $user->status = 0;
        $user->save();
        return redirect()->back()->with('invalid', 'User has been disabled successfully');
    }
    public function enableUser($id)
    {
        $user = User::find($id);
        $user->status = 1;
        $user->save();
        return redirect()->back()->with('status', 'User has been enabled successfully');
    }

    public function createUsers(){
        return view('admin.users.add_user');  
    }

    public function storeUsers(Request $request){
     
        //dd($request->all());
        $validated = $request->validate([
            'fname' => 'required|max:50',
            'lname' => 'required|max:50',
            'gender' => 'required',
            'email' => 'required|email|unique:users',
            'role' => 'required',
            'password'  => 'required|between:8,255|confirmed',
            'password_confirmation' => 'required'
        ]);
        if($validated)
        {
            $user = User::create([
                'fname' => $request->fname,
                'lname' => $request->lname,
                'gender' => $request->gender,
                'email' => $request->email,
                'role'  => $request->role,
                'department_id' => $request->department,
                'campus' => $request->campus_id,
                'password' => Hash::make($request->password),
            ]);

            if($user)
            {
                $roleId = Role::where('name',$request->role)->first();
                if(!empty($roleId))
                {
                   $user->roles()->sync($roleId->id);
                  // $permission->syncRoles($roles);
                  // $user->syncRoles([$role->name]);
                }
                else
                {
                    return redirect()->back()->with('status', 'Role not found');
                }
            }
            return redirect()->back()->with('status', 'User'.' ' .$request->fname.' '.'created successfully.');
        }
      
    }

    public function editUser($id)
    {
        if(!empty($id))
        {
            $user = User::find($id);
            //dd($user);
        }
        return view('admin.users.edit_user', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        //dd($request->all(), $id);
        $validated = $request->validate([
           'fname' => 'required|max:50',
            'lname' => 'required|max:50',
            'gender' => 'required',
            'email' => 'required|email',
            'role' => 'required',
            'password'  => 'required|between:8,255|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updateUser = User::find($id);
        if(!empty($updateUser))
        {
            $updateUser->update([
                'fname' => $request->fname,
                'lname' => $request->lname,
                'gender' => $request->gender,
                'email' => $request->email,
                'role'  => $request->role,
                'department_id' => $request->department,
                'campus' => $request->campus_id,
                'password' => Hash::make($request->password)
            ]);
            if($updateUser)
            {
                $roleId = Role::where('name',$request->role)->first();
                if(!empty($roleId))
                {
                   $updateUser->roles()->sync($roleId->id);
                  // $permission->syncRoles($roles);
                  // $user->syncRoles([$role->name]);
                }
                else
                {
                    return redirect()->back()->with('status', 'Role not found');
                }
            }
            return redirect()->back()->with('status', 'User'.' ' .$request->fname.' '.'Updated successfully.');
        }
    }

    public function Logout( Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
