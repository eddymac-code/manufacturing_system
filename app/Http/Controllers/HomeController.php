<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use Illuminate\Http\Request;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class HomeController extends Controller
{
    public function __construct()
    {
        if (Sentinel::check()) {
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
                if (Sentinel::authenticateAndRemember($credentials)) {
                    return redirect()->route('dashboard');
                } else {
                    return back()->withInput()->withErrors('Invalid Credentials');
                }
            } else {
                if (Sentinel::authenticate($credentials)) {
                    return redirect()->route('dashboard');
                } else {
                    return back()->withInput()->withErrors('Invalid Credentials');
                }
                
            }
            
        }


    }
}
