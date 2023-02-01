<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    function login(Request $request)
    {
        // return "Hello";
        $user = User::where('UserName', $request->UserName)->first();
        if (!$user) return ["error" => "username or password is not matched"];
        return $user;
    }

    function filter(Request $request) {
        // dd($request->userRole);
        $users = User::where('UserRole', $request->userRole)->get();
        if (!$users) return ["error" => "username or password is not matched"];
        return $users;
    }
}
