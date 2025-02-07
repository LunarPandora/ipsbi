<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $success = Auth::attempt([
            'username' => $request->username,
            'password' => $request->password,
        ]);

        //, $request->has('remember')

        if ($success) {
            $request->session()->regenerate();
            
            $ud = Auth::user();

            $session_dt = array(
                'id' => $ud->id,
                'role' => $ud->role,
                'username' => $ud->username,
                'email' => $ud->email,
                'foto_profil' => $ud->foto_profil
            );

            return response(['LOGIN_SUCCESS', $session_dt]);
        } else {
            return response('LOGIN_FAILED');
        }
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response('LOGOUT_SUCCESS');
    }
}
