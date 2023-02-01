<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PracticeClassController;
use App\Http\Controllers\ProblemController;
use App\Http\Controllers\SubmissionController;
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


/**
 * Practice Classes
 */
// filter
Route::get('/practice-classes/filter', [PracticeClassController::class, 'show']);

// create
Route::post('/practice-classes', [PracticeClassController::class, 'create']);
// update
Route::put('/practice-classes', [AuthController::class, 'login']);
// delete
Route::delete('/practice-classes', [AuthController::class, 'login']);

/**
 * Exercises
 */
// create
Route::post('/exercises', [AuthController::class, 'create']);
// update
Route::put('/exercises', [AuthController::class, 'login']);
// delete
Route::delete('/exercises', [AuthController::class, 'login']);

/**
 * Assignments
 */
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
Route::put('/submissions', [AuthController::class, 'login']);
// delete
Route::delete('/submissions', [AuthController::class, 'login']);

/**
 * Submission reports
 */
// filter
Route::get('/submissions/filter', [SubmissionController::class, 'show']);

// create
Route::post('/submission_reports', [SubmissionController::class, 'create']);
// update
Route::put('/submission_reports', [AuthController::class, 'login']);
// delete
Route::delete('/submission_reports', [AuthController::class, 'login']);


/**
 * Problems
 */
// filter
Route::get('/problems/filter', [ProblemController::class, 'show']);

// create
Route::post('/problems', [AuthController::class, 'create']);
// update
Route::put('/problems', [AuthController::class, 'login']);
// delete
Route::delete('/problems', [AuthController::class, 'login']);

/**
 * Test cases
 */
// create
Route::post('/testcases', [AuthController::class, 'create']);
// update
Route::put('/testcases', [AuthController::class, 'login']);
// delete
Route::delete('/testcases', [AuthController::class, 'login']);
