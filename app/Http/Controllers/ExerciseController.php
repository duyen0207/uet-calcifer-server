<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class ExerciseController extends Controller
{
    // get
    function get($exerciseId, Request $request)
    {
        $user = $request->user();
        $exercise = DB::select("CALL Proc_Exercise_GetById(?)", array($exerciseId));
        $testCases = DB::select("CALL Proc_Problem_GetAllTestCases(?)", array($exercise[0]->ProblemId));

        $data = [
            "exercise" => $exercise[0],
            "tests" => $testCases
        ];
        return
            response([
                'message' => 'Load exercise successfully.',
                'user' => $request->user()->UserId,
                'data' => $data
            ], 201);
    }


    // show
    function getAllExercises(Request $request)
    {
        $classId = $request->classId;

        $data = DB::select("CALL Proc_Exercises_GetAllExercisesByClassId(?)", array($classId));

        return
            response([
                'message' => 'Load classes successfully.',
                'user' => $request->user()->UserId,
                'data' => $data
            ], 201);
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
            // 'ExerciseId' => Str::uuid()->toString(),
            'ProblemId' => $req->ProblemId,
            'ClassId' => $req->ClassId,
            'OpenTime' => $req->OpenTime,
            'CloseTime' => $req->CloseTime,
            'MaxSubmissions' => $req->MaxSubmissions,
            'ExerciseType' => $req->ExerciseType,
            'CreatedTime' => now(),
            'CreatedBy' => $req->CreatedBy,
            'ModifiedTime' => now(),
            'ModifiedBy' => $req->ModifiedBy
        ]);

        return response([
            'message' => 'Exercise created successfully.' . $exercise,
        ], 201);
    }

    // statistics
    function statistic(Request $request)
    {
        $exerciseId = $request->exerciseId;
        $submittedStudents = DB::select("CALL Proc_Statistic_GetSubmittedStudentsPerTotal(?)", array($exerciseId));
        $markedSubmissions = DB::select("CALL Proc_Statistic_MarkedSubmissionPerTotal(?)", array($exerciseId));
        $highestLowestScore = DB::select("CALL Proc_Statistic_HighestLowestScore(?)", array($exerciseId));
        $listNotSubmitted = DB::select("CALL Proc_Statistic_NotSubmittedStudents(?)", array($exerciseId));

        return
            response([
                'message' => 'Load statistic of exercise successfully.',
                'data' => [
                    "submittedStudents" => $submittedStudents[0],
                    "markedSubmissions" => $markedSubmissions[0],
                    "highestLowestScore" => $highestLowestScore[0],
                    "listNotSubmitted" => $listNotSubmitted
                ]
            ], 201);
    }
}
