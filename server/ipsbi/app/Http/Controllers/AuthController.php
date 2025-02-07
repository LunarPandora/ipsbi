<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class AuthController extends Controller
{
    public function getToken(Request $request)
    {
        return response('', 200)->header('_token', $token);
    }
}
