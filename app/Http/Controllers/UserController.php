<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Imports\UserImport;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class UserController extends Controller
{

    function all()
    {
        return response([
            'message' => 'Load course successfully.',
            'data' => User::all()
        ], 201);
    }
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
        // if ($request->hasFile('file')) {
        //     $file = $request->file('file');
        //     $fileName = $file->getClientOriginalName();
        //     $file->storeAs('uploads', $fileName);
        //     return response()->json(['success' => true]);
        //     dd("Hello", $file);
        // } else {
        //     return response()->json(['nâu' => false]);
        // }

        // dd('hi');
        $user = $request->user();
        $file = $request->file;
        $userType = $request->userType;

        $message = '';
        if ($userType == 0) {
            $message = "sinh viên";
        } else if ($userType == 1) {
            $message = "giảng viên";
        } else {
            $message = "chuyên viên";
        }

        if ($file) {

            $import = new UserImport($user->FullName, $userType);
            $import->import($file);

            if ($import->failures()->isNotEmpty()) {
                return response([
                    'message' => $import->failures(),
                    'data' => $file
                ], 409);
            };

            return response([
                'message' => 'Import ' . $message . ' thành công.',
                'data' => $file,
                'userType' => $userType
            ], 201);
        }


        // return response([
        //     'message' => 'Load course successfully.',
        //     'data' => $file
        // ], 201);
    }

    function export(Request $request)
    {
        return new UsersExport;
    }
}
