<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\User;

class NewPasswordController extends Controller
{
    /**
     * Display the password reset view.
     */
    public function create(Request $request): View
    {
        return view('auth.reset-password', ['request' => $request]);
    }

    /**
     * Handle an incoming new password request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'token' => ['required'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

       // dd($request->all());
        $user = User::where('remember_token', $request->token)->first();
        if(!empty($user)){
            $user->password = Hash::make($request->password);
            $user->remember_token = Str::random(40);
            $user->save();
            return redirect()->route('login')->with('status', 'Password reset successfully');
        }
        else{
            return redirect()->route('login')->with('status', 'Invalid token');
        }

      
    }
}
