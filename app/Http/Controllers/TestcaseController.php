<?php

namespace App\Http\Controllers;

use App\Models\Testcase;
use Illuminate\Http\Request;

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
}
