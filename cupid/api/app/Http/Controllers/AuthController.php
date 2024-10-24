<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255|unique:users',
            'password' => 'required|min:3|confirmed'
        ]);

        $user = User::create($validatedData);
        $token = $user->createToken($user->name)->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Registered successfully.',
            'result' => $user,
            'token' => $token
        ]);
    }

    public function login(Request $request) {
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(!Auth::attempt($validatedData)) {
            return response()->json([
                'message' => 'Invalid credentials, please try again.'
            ]);
        }

        $user = Auth::user();
        $token = $user->createToken($user->name)->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login successfully.',
            'result' => $user,
            'token' => $token
        ]);
    }
}
