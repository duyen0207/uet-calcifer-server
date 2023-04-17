<?php

namespace App\Http\Controllers;

use App\Models\Testcase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TestcaseController extends Controller
{
    //
    // show
    function show(Request $req)
    {
        $userId = $req->UserId;

        $testcasees = Testcase::all();

        return response([
            "message" => "Load dữ liệu thành công.",
            "data" => $testcasees
        ]);
    }

    // create
    function create(Request $req)
    {
        $req->validate([]);

        // $classId = $req->ClassCode . ' N' . $req->ClassGroup;
        // $isExist = Testcase::where('ClassId', $classId)->first();

        // if ($isExist) return response([
        //     'message' => 'This class is already exist.' . $classId,
        // ]);
        $testcase = Testcase::create([
            // 'TestcaseId' => $req->TestcaseId,
            'ProblemId' => $req->ProblemId,
            'Order' => $req->Order,
            'TestcaseDescript' => $req->TestcaseDescript,
            'Score' => $req->Score,
            'Hidden' => $req->Hidden,
            'CreatedTime' => now(),
            'CreatedBy' => $req->CreatedBy
        ]);

        return response([
            'message' => 'Class created successfully.' . $testcase->TestcaseId,
        ], 201);
    }

    // get all test cases
    function getAllTestcase(Request $request)
    {
        $user = $request->user();
        // check if allowed
        if ($user->UserRole == 0 || $user->UserRole == 2)
            return response([
                'message' => "You don't have permission to access.",
                'data' => null
            ], 403);

        $problemId = $request->problemId;
        $testCases = DB::select("CALL Proc_Problem_GetAllTestCases(?)", array($problemId));
        return
            response([
                'message' => 'Load test cases successfully.',
                'data' => $testCases
            ], 201);
    }
}
