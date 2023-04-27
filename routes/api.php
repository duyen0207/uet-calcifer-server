<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\PracticeClassController;
use App\Http\Controllers\ProblemController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\SubmissionReportController;
use App\Http\Controllers\TestcaseController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Public routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/users', [AuthController::class, 'register']);

// Private routes
Route::middleware('auth:sanctum')->group(function () {
    /**
     * User
     */
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/users', [AuthController::class, 'user']);
    Route::get('/users/filter', [UserController::class, 'filter']);
    // update
    // Route::put('/users', [AuthController::class, 'login']);
    // delete
    // Route::delete('/users', [AuthController::class, 'login']);
    // get class of user
    Route::get('/users-classes', [UserController::class, 'my_classes']);

    /**
     * Courses
     */
    // get semester
    Route::get('/semesters', [CourseController::class, 'getLatestSemesters']);
    // get course in semester
    Route::get('/courses', [CourseController::class, 'getCourseByUserAndSemester']);
    Route::get('/theory-classes', [CourseController::class, 'getTheoryClass']);



    /**
     * Practice Classes
     */
    // filter
    Route::get('/practice-classes/filter', [PracticeClassController::class, 'show']);

    // get members
    Route::get('/practice-classes/{classId}/members', [PracticeClassController::class, 'getAllMembers']);

    // get by id
    Route::get('/practice-classes/{classId}', [PracticeClassController::class, 'get']);

    // get by code
    Route::get('/practice-classes', [PracticeClassController::class, 'getByClassCode']);

    // create
    Route::post('/practice-classes', [PracticeClassController::class, 'create']);
    // update
    Route::put('/practice-classes', [PracticeClassController::class, 'login']);
    // delete
    Route::delete('/practice-classes', [PracticeClassController::class, 'login']);

    /**
     * Exercises
     */
    // get by id
    Route::get('/exercises/{exerciseId}', [ExerciseController::class, 'get']);

    // get list by class id
    Route::get('/exercises', [ExerciseController::class, 'getAllExercises']);


    // create
    Route::post('/exercises', [ExerciseController::class, 'create']);
    // update
    Route::put('/exercises', [ExerciseController::class, 'login']);
    // delete
    Route::delete('/exercises', [ExerciseController::class, 'login']);


    /**
     * Submissions
     */
    // get all by exercise id under authorization
    Route::get('/submissions', [SubmissionController::class, 'getAllOfExercise']);

    // filter
    Route::get('/submissions/filter', [SubmissionController::class, 'show']);
    // create
    Route::post('/submissions', [SubmissionController::class, 'create']);
    // update
    Route::put('/submissions', [SubmissionController::class, 'login']);
    // delete
    Route::delete('/submissions', [SubmissionController::class, 'login']);


    /**
     * Submission reports
     */
    // get
    Route::get('/submission-reports', [SubmissionReportController::class, 'getAllReports']);
    // create
    Route::post('/submission-reports', [SubmissionReportController::class, 'create']);
    // update
    Route::put('/submission-reports', [SubmissionReportController::class, 'login']);
    // delete
    Route::delete('/submission-reports', [SubmissionReportController::class, 'login']);


    /**
     * Problems
     */
    // filter
    Route::get('/problems/filter', [ProblemController::class, 'show']);

    // create
    Route::post('/problems', [ProblemController::class, 'create']);
    // update
    Route::put('/problems', [ProblemController::class, 'login']);
    // delete
    Route::delete('/problems', [ProblemController::class, 'login']);


    /**
     * Test cases
     */
    // get all by problem id
    Route::get('/testcases', [TestcaseController::class, 'getAllTestcase']);
    // filter
    Route::get('/testcases/filter', [TestcaseController::class, 'show']);

    // create
    Route::post('/testcases', [TestcaseController::class, 'create']);
    // update
    Route::put('/testcases', [TestcaseController::class, 'login']);
    // delete
    Route::delete('/testcases', [TestcaseController::class, 'login']);

    // statistic
    Route::get("/statistic/exercises", [ExerciseController::class, "statistic"]);
});

/**
 * Assignments
 */
// filter
Route::get('/assignments/filter', [PracticeClassController::class, 'show']);

// create
Route::post('/assignments', [AuthController::class, 'create']);
// update
Route::put('/assignments', [AuthController::class, 'login']);
// delete
Route::delete('/assignments', [AuthController::class, 'login']);










Route::fallback(function () {
    //
});
