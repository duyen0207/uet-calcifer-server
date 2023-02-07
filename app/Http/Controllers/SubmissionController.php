<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    //
    // show
    function show(Request $req)
    {
        $userId = $req->UserId;

        $submissiones = Submission::all();

        return response([
            "message" => "Load dữ liệu thành công.",
            "data" => $submissiones
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
            'SubmissionId' => $req->SubmissionId,
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
}
