<?php

namespace App\Http\Controllers;

use App\Models\User;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    //
    function register(Request $req)
    {
        $req->validate([
            'UserName' => 'required',
            'Password' => 'required',
            'UserRole' => 'required',
            'FullName' => 'required',
            'Email' => 'required',

        ]);

        $user = User::create([
            // 'UserId' => Str::uuid()->toString(),
            'UserName' => $req->UserName,
            // 'Password' => Hash::make($req->Password),
            'Password' => $req->Password,
            'UserRole' => $req->UserRole,
            'FullName' => $req->FullName,
            'Email' => $req->Email,
            'DateOfBirth' => $req->DateOfBirth,
            'CourseClass' => $req->CourseClass,
            'CreatedTime' => now(),
            'CreatedBy' => $req->CreatedBy,
        ]);

        // $token = $user->createToken($user->UserId)->plainTextToken;
        return response([
            'message' => 'Account created successfully.' . $req->FullName,
            'data' => $user
            // 'token' => $token,
            // 'token_type' => 'Bearer'
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
            return response([
                'messages' => ['Wrong information.']
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;
        return response([
            'message' => 'Logged in successfully.' . $user->Password,
            'token' => $token,
            'token_type' => 'Bearer',
            'FullName' => $user->FullName,
            'UserRole' => $user->UserRole,
            'user' => $user,
        ], 201);
    }

    function user(Request $request)
    {
        return $request->user();
    }

    function logout(Request $req)
    {
        $req->user()->tokens()->delete();
        return response([
            'message' => 'Logged out successfully.',
        ]);
    }
}
