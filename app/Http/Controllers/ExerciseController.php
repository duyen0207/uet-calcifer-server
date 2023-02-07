<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ExerciseController extends Controller
{
    //
    // show
    function show(Request $req)
    {
        $userId = $req->UserId;

        $exercisees = Exercise::all();

        return response([
            "message" => "Load bài tập thành công.",
            "classes" => $exercisees
        ]);
    }

    // create
    function create(Request $req)
    {
        $req->validate([]);

        // $classId = $req->ClassCode . ' N' . $req->ClassGroup;
        // $isExist = Exercise::where('ClassId', $classId)->first();

        // if ($isExist) return response([
        //     'message' => 'This class is already exist.' . $classId,
        // ]);
        $exercise = Exercise::create([
            // 'ExerciseId' => $req->ExerciseId,
            'ExerciseId' => Str::uuid()->toString(),
            'ProblemId' => $req->ProblemId,
            'ClassId' => $req->ClassId,
            // 'OpenTime' => $req->OpenTime,
            // 'CloseTime' => $req->CloseTime,
            'OpenTime' => now(),
            'CloseTime' => now(),
            'MaxSubmissions' => $req->MaxSubmissions,
            'ExerciseType' => $req->ExerciseType,
            'CreatedTime' => now(),
            'CreatedBy' => $req->CreatedBy,
            'ModifiedTime' => now(),
            'ModifiedBy' => $req->ModifiedBy
        ]);

        return response([
            'message' => 'Exercise created successfully.' . $exercise->ExerciseId,
        ], 201);
    }
}
