<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\PracticeClassController;
use App\Http\Controllers\ProblemController;
use App\Http\Controllers\SubmissionController;
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

// auth
// login
Route::post('/login', [AuthController::class, 'login']);
// logout
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

/**
 * User
 */
// show
Route::middleware('auth:sanctum')->get('/users', function (Request $request) {
    return $request->user();
});
// Route::middleware('auth:sanctum')->get('/users/filter', [UserController::class, 'filter']);
Route::get('/users/filter', [UserController::class, 'filter']);
// create
Route::post('/users', [AuthController::class, 'register']);
// update
Route::put('/users', [AuthController::class, 'login']);
// delete
Route::delete('/users', [AuthController::class, 'login']);
// get class of user
Route::get('/users-classes', [UserController::class, 'my_classes']);


/**
 * Practice Classes
 */
// filter
Route::get('/practice-classes/filter', [PracticeClassController::class, 'show']);

// create
Route::post('/practice-classes', [PracticeClassController::class, 'create']);
// update
Route::put('/practice-classes', [PracticeClassController::class, 'login']);
// delete
Route::delete('/practice-classes', [PracticeClassController::class, 'login']);

/**
 * Exercises
 */
// filter
Route::get('/exercises/filter', [ExerciseController::class, 'show']);

// create
Route::post('/exercises', [ExerciseController::class, 'create']);
// update
Route::put('/exercises', [ExerciseController::class, 'login']);
// delete
Route::delete('/exercises', [ExerciseController::class, 'login']);

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

/**
 * Submissions
 */
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
// filter
Route::get('/submissions/filter', [SubmissionController::class, 'show']);

// create
Route::post('/submission_reports', [SubmissionController::class, 'create']);
// update
Route::put('/submission_reports', [SubmissionController::class, 'login']);
// delete
Route::delete('/submission_reports', [SubmissionController::class, 'login']);


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
// filter
Route::get('/testcases/filter', [TestcaseController::class, 'show']);

// create
Route::post('/testcases', [TestcaseController::class, 'create']);
// update
Route::put('/testcases', [TestcaseController::class, 'login']);
// delete
Route::delete('/testcases', [TestcaseController::class, 'login']);
