<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Mail\RegisterMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'phone' => 'required',
            'fname' => ['required', 'string', 'max:255'],
            'lname' => ['required', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'email' => $request->email,
            'country' => $request->country,
            'phone' => $request->phone,
            'role'  => 'applicant',
            'remember_token' => Str::random(40),
            'password' => Hash::make($request->password),
        ]);

        if($user){
           Mail::to($user->email)->send(new RegisterMail($user));
            return redirect()->route('login')->with('status', 'Go to your email and verify your account');
        }
    }

    public function verify($token)
    {
        $user = User::where('remember_token', $token)->first();
        if(!empty($user)){
            $user->email_verified_at = date('Y-m-d H:i:s');
            $user->remember_token = Str::random(40);
            $user->save();
            return redirect()->route('login')->with('status', 'Account verified successfully.');
        }else{
            return redirect()->route('login')->with('invalid', 'Invalid token.');
        }
    }
}
