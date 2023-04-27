<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubmissionReportController extends Controller
{
    //
    function getAllReports(Request $request)
    {
        $user = $request->user();
        $submissionId = $request->submissionId;

        $submissionReports = [];

        // check if allowed
        if ($user->UserRole == 2) {
            return response([
                'message' => "You don't have permission to access.",
                'data' => null
            ], 403);
        } else if ($user->UserRole == 0 || $user->UserRole == 1 || $user->UserRole == 3) {
            // student
            $submissionReports = DB::select("CALL Proc_SubmissionReport_GetOf(?)", array($submissionId));
        }

        return
            response([
                'message' => 'Load submissionReports successfully.',
                'data' => $submissionReports
            ], 201);
    }
}
