<?php

namespace App\Http\Controllers;

use App\Models\PracticeClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PracticeClassController extends Controller
{
    // show
    function show(Request $request)
    {
        $user = $request->user();
        $semester = $request->semester;

        $practice_classes = [];

        if ($user->UserRole == 2 || $user->UserRole == 3) {
            $practice_classes = DB::select("CALL Proc_PracticeClass_GetAllBySemester(?)", array($semester));
        }

        return
            response([
                'message' => 'Load classes successfully.',
                'user' => $request->user()->UserName,
                'data' => $practice_classes
            ], 201);
    }

    // create
    function create(Request $request)
    {
        $request->validate([
            // 'ClassId' => 'required',
            'ClassCode' => 'required',
            // 'ClassGroup' => 'required',
            // 'Semester' => 'required',

        ]);

        $classId = $request->ClassCode . ' N' . $request->ClassGroup;
        $isExist = PracticeClass::where('ClassId', $classId)->first();

        if ($isExist) return response([
            'message' => 'This class is already exist.' . $classId,
        ]);
        $practice_class = PracticeClass::create([
            'ClassId' => $classId,
            'ClassCode' => $request->ClassCode,
            'ClassGroup' => 1,
            'Semester' => "I 2022-2023",
            'CreatedTime' => now(),
            'CreatedBy' => $request->CreatedBy,
        ]);

        return response([
            'message' => 'Class created successfully.' . $practice_class->ClassId,
        ], 201);
    }

    // get by id
    function get($classId)
    {
        $practice_class = PracticeClass::find($classId);
        $message = "";
        return response([
            "message" => "Lớp học là",
            "data" => $practice_class,
            "classId" => $classId
        ]);
    }

    //get practice classes by theory code
    function getByClassCode(Request $request)
    {
        $userId = $request->user()->UserId;
        $semester = $request->semester;
        $classCode = $request->classCode;
        $data = DB::select("CALL Proc_PracticeClass_GetByClassCode(?,?,?)", array($classCode, $semester, $userId));
        return
            response([
                'message' => 'Load classes successfully.',
                'user' => $request->user()->UserId,
                'semester' => $semester,
                "classCode" => $classCode,
                'data' => $data
            ], 201);
    }

    // get members of class
    function getAllMembers($classId, Request $request)
    {
        $user = $request->user();
        // $practiceClass = DB::select("CALL Proc_PracticeClass_GetById(?)", array($classId));

        $students = DB::select("CALL Proc_PracticeClass_GetAllStudents(?)", array($classId));
        $teachers = DB::select("CALL Proc_Manage_GetAllTeachersByClassCode(?)", array($classId));

        // unset($students['FirstName']);

        return
            response([
                'message' => 'Load classes successfully.',
                'user' => $request->user()->UserName,
                'data' => [
                    "lecturers" => $teachers,
                    "students" => $students
                ]
            ], 201);
    }
}
