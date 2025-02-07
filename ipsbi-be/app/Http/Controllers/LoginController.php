<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        dd($request);
        // $success = auth()->attempt([
        //     'username' => $request->input('username'),
        //     'password' => $request->input('password'),
        // ], $request->has('remember'));

        // if ($success) {
        //     // User is authenticated
        //     return redirect()->intended('/dashboard'); // Redirect to the dashboard or any other route
        // } else {
        //     // Authentication failed
        //     return redirect()->route('login')->with('error', 'Invalid credentials');
        // }
    }
}
