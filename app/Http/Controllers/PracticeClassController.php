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
            "messages" => "Load lớp học thành công.",
            "classes" => $practice_classes
        ]);
    }

    // create
    function create(Request $req)
    {
        $req->validate([
            // 'ClassId' => 'required',
            'LMHCode' => 'required',
            // 'ClassGroup' => 'required',
            // 'Semester' => 'required',

        ]);

        $classId = $req->LMHCode . ' N' . $req->ClassGroup;
        $isExist = PracticeClass::where('ClassId', $classId)->first();

        if ($isExist) return response([
            'message' => 'This class is already exist.' . $classId,
        ]);
        $practice_class = PracticeClass::create([
            'ClassId' => $classId,
            'LMHCode' => $req->LMHCode,
            'ClassGroup' => $req->ClassGroup | 1,
            'Semester' => $req->Semester | "I 2022-2023",
            'CreatedTime' => now(),
            'CreatedBy' => $req->CreatedBy,
        ]);

        return response([
            'message' => 'Class created successfully.' . $practice_class->ClassId,
        ], 201);
    }
}
