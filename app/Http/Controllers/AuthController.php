<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        $user = User::where('email', $request->email)->first();
     
        if (!$user || !Hash::check($request->password, $user->password)) {
            return 'The provided credentials are incorrect.';
        }
     
        return [
            "Successfully logged in!", 
            $user->createToken($user->email)->plainTextToken
        ];
    }

    public function register(Request $request){
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'unique:users'],
            'password' => ['required', 'confirmed']
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return "Successfully registered!";
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return 'Successfully logged out!';
    }
}
