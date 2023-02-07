<?php

namespace App\Http\Controllers;

use App\Models\PracticeClass;
use Illuminate\Http\Request;

class PracticeClassController extends Controller
{
    // show
    function show(Request $req)
    {
        $userId = $req->UserId;

        $practice_classes = PracticeClass::all();

        return response([
            "message" => "Load dữ liệu thành công.",
            "data" => $practice_classes
        ]);
    }

    // create
    function create(Request $req)
    {
        $req->validate([
            // 'ClassId' => 'required',
            'ClassCode' => 'required',
            // 'ClassGroup' => 'required',
            // 'Semester' => 'required',

        ]);

        $classId = $req->ClassCode . ' N' . $req->ClassGroup;
        $isExist = PracticeClass::where('ClassId', $classId)->first();

        if ($isExist) return response([
            'message' => 'This class is already exist.' . $classId,
        ]);
        $practice_class = PracticeClass::create([
            'ClassId' => $classId,
            'ClassCode' => $req->ClassCode,
            'ClassGroup' => 1,
            'Semester' => "I 2022-2023",
            'CreatedTime' => now(),
            'CreatedBy' => $req->CreatedBy,
        ]);

        return response([
            'message' => 'Class created successfully.' . $practice_class->ClassId,
        ], 201);
    }
}
