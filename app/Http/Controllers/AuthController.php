<?php

namespace App\Http\Controllers;

use App\Models\User;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    function register(Request $req)
    {
        $req->validate([
            'UserName' => 'required',
            'Password' => 'required',
            'Role' => 'required',
            'FullName' => 'required',
            'Email' => 'required',

        ]);

        $user = User::create([
            // 'UserId' => ,
            'UserName' => $req->UserName,
            'Password' => Hash::make($req->Password),
            'Role' => $req->Role,
            'FullName' => $req->FullName,
            'Email' => $req->Email,
            'DateOfBirth' => $req->DateOfBirth,
            'CourseClass' => $req->CourseClass,
            'CreatedTime' => now(),
            'CreatedBy' => $req->CreatedBy,
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;
        return response([
            'message' => 'Account created successfully.' . $req->FullName,
            'token' => $token,
            'token_type' => 'Bearer'
        ]);
    }

    function login(Request $req)
    {
        $req->validate([
            'UserName' => 'required',
            'Password' => 'required',
        ]);

        $user = User::where('UserName', $req->UserName)->first();

        // if (!$user || !Hash::check($req->Password, $user->Password)) {
        if (!$user || !($req->Password == $user->Password)) {
            // throw ValidationException::withMessages([

            // ]);
            return [
                'messages' => ['Wrong information.']
            ];
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        return response([
            'message' => 'Logged in successfully.' . $user->Password,
            'token' => $token,
            'FullName' => $user->FullName,
            'UserRole' => $user->UserRole,
            'user' => $user,
            'token_type' => 'Bearer'
        ], 201);
    }

    function logout(Request $req)
    {
        $req->user()->tokens()->delete();
        return response([
            'message' => 'Logged out successfully.',
        ]);
    }
}
