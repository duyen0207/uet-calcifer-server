<?php

namespace App\Http\Controllers;

use App\Models\Problem;
use App\Models\Testcase;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProblemController extends Controller
{
    //
    // show
    function show(Request $req)
    {
        // $userId = $req->UserId;

        $problems = Problem::all();

        return response([
            "message" => "Load dữ liệu thành công.",
            "data" => $problems
        ]);
    }

    // create
    function create(Request $req)
    {
        $req->validate([]);

        // $classId = $req->ClassCode . ' N' . $req->ClassGroup;
        // $isExist = Problem::where('ClassId', $classId)->first();

        // if ($isExist) return response([
        //     'message' => 'This class is already exist.' . $classId,
        // ]);
        $problem = Problem::create([
            'ProblemTitle' => $req->ProblemTitle,
            'Tags' => $req->Tags,
            'ProblemContent' => $req->ProblemContent,
            'NumberOfTestcase' => $req->NumberOfTestcase,
            'TestcaseScript' => $req->TestcaseScript,
            'CreatedTime' => now(),
            'CreatedBy' => $req->CreatedBy,
            'ModifiedTime' => now(),
            'ModifiedBy' => $req->ModifiedBy
        ]);

        // foreach ($req->testcases as $testcase) {
        //     $problemTestcases = Testcase::create([
        //         'TestcaseId' => $testcase->TestcaseId,
        //         'ProblemId' => $req->ProblemId,
        //         'Order' => $testcase->Order,
        //         'TestcaseDescript' => $testcase->TestcaseDescript,
        //         'Score' => $testcase->Score,
        //         'Hidden' => $testcase->Hidden,
        //         'CreatedTime' => now(),
        //         'CreatedBy' => $testcase->CreatedBy
        //     ]);
        // }

        // dd($req->testcases);
        // $testcaseData = json_decode($req->testcases, true);
        // $testcaseData = $req->testcases[0]['TestcaseId'];
        // echo $testcaseData;
        // for ($i = 0; $i <= count($testcaseData); $i++) {
        //     $problemTestcases = Testcase::create([
        //         'TestcaseId' => $req->testcases[$i]['TestcaseId'],
        //         'ProblemId' => $req->ProblemId,
        //         'Order' => $req->testcases[$i]['Order'],
        //         'TestcaseDescript' => $req->testcases[$i]['TestcaseDescript'],
        //         'Score' => $req->testcases[$i]['Score'],
        //         'Hidden' => $req->testcases[$i]['Hidden'],
        //         'CreatedTime' => now(),
        //         'CreatedBy' => $req->testcases[$i]['CreatedBy']
        //     ]);
        // }

        return response([
            'message' => 'Problem: ' . $problem->ProblemTitle . ' created successfully.',
            'data' => $problem
        ], 201);
    }
}
