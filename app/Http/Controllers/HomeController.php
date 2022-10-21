<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        //check whether a user is logged in and redirect to dashboard if so.
        if (Auth::check()) {
            return redirect('dashboard')->send();
        }
    }

    public function login()
    {
        return view('admin.login');
    }

    public function processLogin(LoginFormRequest $request)
    {
        $validated = $request->validated();

        if (!$validated) {
            return redirect()->back()->withErrors($validated);
        } else {
            $credentials = [
                'email' => $validated['email'],
                'password' => $validated['password']
            ];

            if (!empty($request->remember)) {
                if (Auth::attempt($credentials, $request->remember)) {
                    $request->session()->regenerate();

                    return redirect()->intended('dashboard');
                } else {
                    return back()->withInput()->withErrors('Invalid Credentials');
                }
            } else {
                if (Auth::attempt($credentials)) {
                    $request->session()->regenerate();

                    return redirect()->intended('dashboard');
                } else {
                    return back()->withErrors([
                        'email' => 'Provided credentials don\'t match our records.'
                    ])->onlyInput('email');
                }                
            }            
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
    
        return redirect('/');
    }
}
