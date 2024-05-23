<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class emailAndUsernameLoginController extends Controller
{
    public function emailAndRegistration()
    {
        return view('admin.login.emailandregistration');
    }

    public function emailOrRegistration(Request $request)
    {
        $credentials = $request->only('emailORreg', 'password');

        if (Auth::attempt(['email' => $credentials['emailORreg'], 'password' => $credentials['password']])) {
            // Authentication passed using email
            return redirect()->intended('dashboard');
        }
    
        if (Auth::attempt(['username' => $credentials['emailORreg'], 'password' => $credentials['password']])) {
            // Authentication passed using username
            return redirect()->intended('dashboard');
        }
    
        // Authentication failed
        return back()->withErrors(['login' => 'Invalid credentials']);
    
    }
}
