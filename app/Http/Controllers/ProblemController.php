<?php

namespace App\Http\Controllers;

use App\Models\Problem;
use Illuminate\Http\Request;

class ProblemController extends Controller
{
    //
    // show
    function show(Request $req)
    {
        $userId = $req->UserId;

        $practice_classes = Problem::all();

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
        // $isExist = Problem::where('ClassId', $classId)->first();

        // if ($isExist) return response([
        //     'message' => 'This class is already exist.' . $classId,
        // ]);
        $practice_class = Problem::create([
            // 'ProblemId'=>$req->ProblemId,
            'ProblemTitle' => $req->ProblemTitle,
            'Tags' => $req->Tags,
            'ProblemContent' => $req->ProblemContent,
            'NumberOfTestcase' => $req->NumberOfTestcase,
            'TestcaseScript' => $req->TestcaseScript,
            'CreatedTime' => $req->CreatedTime,
            'CreatedBy' => $req->CreatedBy,
            'ModifiedTime' => $req->ModifiedTime,
            'ModifiedBy' => $req->ModifiedBy
        ]);

        return response([
            'message' => 'Class created successfully.' . $practice_class,
        ], 201);
    }
}
