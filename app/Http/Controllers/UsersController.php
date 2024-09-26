<?php

namespace App\Http\Controllers;

use App\Models\Feecategory;
use App\Models\Programclass;
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
        $user = Auth::user();
        $data['class'] = $user->programclass;
        $data['campus'] = $user->campus;
        if($data['campus']=='Lilongwe')
        {
            $data['campus'] ='1';
        }
        if($data['campus']=='Blantyre')
        {
            $data['campus'] ='2';
        }
        if($data['campus']=='Zomba')
        {
            $data['campus'] ='3';
        }

        $data['studentClass'] = Programclass::where('classcode', $data['class'])->where('campus_id', $data['campus'])->first();
        $data['fees'] = Feecategory::findOrFail($data['studentClass']->feecategory_id);
        // deductions of fees here// there will a table called student fees with all the fees of the student with an id for
        // for each payment.
        
        return view('admin.student.dashboard', $data);
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
    } // end function 

    public function editUserPassword()
    {
        $user = Auth::user();
        return view('admin.users.edit_user_password', compact('user'));

    } // end function

    public function updateUserPassword(Request $request)
    {
        $validated = $request->validate([
            'old_password' => 'required|min:6|max:100',
            'new_password' => 'required|min:6|max:100',
            'confirm_password' => 'required|same:new_password',
            ]);
        if($validated)
        {
            $user = Auth::user();
            if(Hash::check($request->old_password, $user->password));
            {
                $currentUser = User::where('id', $user->id)->first();
                if($currentUser)
                $currentUser->update([
                'password' => Hash::make($request->new_password),
                ]);
                return redirect()->back()->with('status', 'Password Updated successfully.');
            }
        }
       
    } // end function

    public function resetUserPassword($id)
    {
        $user = User::findOrFail($id);
        if($user)
        {
            return view('admin.users.reset_user_password', compact('user'));
        }
    } // end function

    public function adminUpdateUserPassword(Request $request, $id)
    {
        $validated = $request->validate([
            'new_password' => 'required|min:6|max:100',
            'confirm_password' => 'required|same:new_password',
        ]);

        if($id)
        {
            $user = User::findOrFail($id);
            if($user)
            {
                $user->update([
                    'password' => Hash::make($request->new_password),
                ]);
            }
            return redirect()->back()->with('status', 'Password Updated successfully.');
        }
    } // end function

   

    public function Logout( Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
