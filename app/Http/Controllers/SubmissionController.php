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

        $practice_classes = Submission::all();

        return response([
            "messages" => "Load lớp học thành công.",
            "classes" => $practice_classes
        ]);
    }

    // create
    function create(Request $req)
    {
        $req->validate([]);

        // $classId = $req->LMHCode . ' N' . $req->ClassGroup;
        // $isExist = Submission::where('ClassId', $classId)->first();

        // if ($isExist) return response([
        //     'message' => 'This class is already exist.' . $classId,
        // ]);
        $practice_class = Submission::create([
            // 'SubmissionId' => $req->SubmissionId,
            'ExerciseId' => $req->ExerciseId,
            'StudentId' => $req->StudentId,
            'Iter' => $req->Iter,
            'SubmittedLink' => $req->SubmittedLink,
            'TestcaseResult' => $req->TestcaseResult,
            'Score' => $req->Score,
            // 'CreatedTime' => $req->CreatedTime
        ]);

        return response([
            'message' => 'Class created successfully.' . $practice_class,
        ], 201);
    }
}
