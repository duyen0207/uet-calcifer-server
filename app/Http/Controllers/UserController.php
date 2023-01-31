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
}
