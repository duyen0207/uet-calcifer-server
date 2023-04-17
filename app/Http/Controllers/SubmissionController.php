<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubmissionController extends Controller
{
    //
    // show
    function show(Request $req)
    {
        $userId = $req->UserId;

        $submissions = Submission::all();

        return response([
            "message" => "Load dữ liệu thành công.",
            "data" => $submissions
        ]);
    }

    // create
    function create(Request $req)
    {
        $req->validate([]);

        // $classId = $req->ClassCode . ' N' . $req->ClassGroup;
        // $isExist = Submission::where('ClassId', $classId)->first();

        // if ($isExist) return response([
        //     'message' => 'This class is already exist.' . $classId,
        // ]);
        $submission = Submission::create([
            // 'SubmissionId' => $req->SubmissionId,
            'ExerciseId' => $req->ExerciseId,
            'StudentId' => $req->StudentId,
            'Iter' => $req->Iter,
            'SubmittedLink' => $req->SubmittedLink,
            // 'TestcaseResult' => $req->TestcaseResult,
            // 'Score' => $req->Score,
            'CreatedTime' => now()
        ]);

        return response([
            'message' => 'Class created successfully.' . $submission->SubmittedLink,
        ], 201);
    }

    // get all by exercise id
    function getAllOfExercise(Request $request)
    {
        $user = $request->user();
        // check if allowed
        if ($user->UserRole == 0 || $user->UserRole == 2)
            return response([
                'message' => "You don't have permission to access.",
                'data' => null
            ], 403);

        $exerciseId = $request->exerciseId;
        $submissions = DB::select("CALL Proc_Submission_GetAllOfExercise(?)", array($exerciseId));
        return
            response([
                'message' => 'Load submissions successfully.',
                'data' => $submissions
            ], 201);
    }
}
