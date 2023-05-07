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
        $req->validate([
            'SubmittedLink' => 'required'
        ]);

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

        if ($submission) return response([
            'message' => 'Nộp bài thành công.',
        ], 201);
        else return response([
            'message' => 'Có lỗi xảy ra. Vui lòng kiểm tra lại bài nộp' . $submission->SubmittedLink,
        ], 400);
    }

    // get all by exercise id
    function getAllOfExercise(Request $request)
    {
        $user = $request->user();
        $exerciseId = $request->exerciseId;

        $submissions = [];

        // check if allowed
        if ($user->UserRole == 2) {
            return response([
                'message' => "You don't have permission to access.",
                'data' => null
            ], 403);
        } else if ($user->UserRole == 0) {
            // student
            $submissions = DB::select("CALL Proc_Submission_GetByUserAndExercise(?,?)", array($user->UserId, $exerciseId));
        } else {
            // teacher
            $submissions = DB::select("CALL Proc_Submission_GetAllOfExercise(?)", array($exerciseId));
        }
        return
            response([
                'message' => 'Load submissions successfully.',
                'data' => $submissions
            ], 201);
    }
}
