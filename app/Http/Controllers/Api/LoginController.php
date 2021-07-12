<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
            'name' => 'required'
        ]);

        //login true
        if (Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Authentication success.',
                'token' => $request->user()->createToken($request->name)->plainTextToken
            ], 200);
        }
        //login false
        return response()->json([
            'error' => 'Unauthorized.'
        ], 401);
    }

}
