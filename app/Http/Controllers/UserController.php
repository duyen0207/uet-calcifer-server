<?php

namespace App\Http\Controllers;

use App\Imports\UserImport;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

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

    function filter(Request $request)
    {
        // dd($request->userRole);
        $userRole = $request->userRole;
        $users = User::where('UserRole', $userRole)->get();
        // if (!$users) return ["error" => "username or password is not matched"];
        return
            response([
                'message' => 'Load user by role successfully.',
                'data' => $users
            ], 201);
    }

    function my_classes(Request $req)
    {
        $my_classes = User::find('SV-19021254')->practice_classes()->get();
        return response([
            'message' => 'Load course successfully.',
            'data' => $my_classes
        ], 201);
    }

    function import(Request $request)
    {
        // $userRole=$request->userRole;
        $file = $request->file;

        if ($file) {

            $import = new UserImport;
            $import->import($file);

            dd($import->failures());

            return response([
                'message' => 'Import successfully.',
                'data' => $file
            ], 201);
        }


        // return response([
        //     'message' => 'Load course successfully.',
        //     'data' => $file
        // ], 201);
    }
}
