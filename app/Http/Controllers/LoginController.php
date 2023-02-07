<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(LoginRequest $request)
    {
        if(Auth::attempt($request->validated())){

            $user = Auth::user();

            $token = match($user->role){
                'admin' => $user->createToken('ADMIN', ['all'])->plainTextToken,
                'student' => $user->createToken('STUDENT', [])->plainTextToken,
                'teacher' => $user->createToken('TEACHER', [])->plainTextToken
            };

            $user->token = $token;

            return response()->json(['user' => $user]);
        }

        return response()->json(['error' => 'las credenciales no son validas'], 500);
    }
}
