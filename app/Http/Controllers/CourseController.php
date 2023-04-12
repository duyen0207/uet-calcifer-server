<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    //
    function getLatestSemesters(Request $request)
    {
        $latestSemester = DB::select("CALL Proc_Other_GetLatestSemesters");
        // print_r($latestSemester);
        return
            response([
                'message' => 'Load semester successfully.',
                'data' => $latestSemester
            ], 201);
    }

    function getCourseByUserAndSemester(Request $request)
    {
        $data = DB::select("CALL Proc_PracticeClass_GetByUserAndSemester('II 2022-2023', 'GV-0001')");
        return
            response([
                'message' => 'Load course successfully.',
                'data' => $data
            ], 201);
    }
}
