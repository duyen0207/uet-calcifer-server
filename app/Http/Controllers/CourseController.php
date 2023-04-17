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
        $userId = $request->user()->UserId;
        $latestSemester = DB::select("Call Proc_Advance_GetSemestersByUser(?)", array($userId));

        return
            response([
                'message' => 'Load semester successfully.',
                'userId' => $userId,
                'data' => $latestSemester
            ], 201);
    }

    function getTheoryClass(Request $request)
    {
        $userId = $request->user()->UserId;
        $semester = $request->semester;
        $data = DB::select("CALL Proc_Other_GetTheoryClassByUser(?,?)", array($userId, $semester));
        return
            response([
                'message' => 'Load theory classes successfully.',
                'user' => $request->user()->UserId,
                'semester' => $semester,
                'data' => $data
            ], 201);
    }

    function getCourseByUserAndSemester(Request $request)
    {
        $userId = $request->user()->UserId;
        $semester = $request->semester;
        $data = DB::select("CALL Proc_PracticeClass_GetByUserAndSemester(?,?)", array($semester, $userId));
        return
            response([
                'message' => 'Load course successfully.',
                'user' => $request->user()->UserId,
                'semester' => $semester,
                'data' => $data
            ], 201);
    }
}
