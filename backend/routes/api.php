<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GradeController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

Route::apiResource('users', UserController::class);

Route::apiResource('groups', GroupController::class);

Route::apiResource('students', StudentController::class);

Route::apiResource('teachers', TeacherController::class);

Route::apiResource('subject', SubjectController::class);

Route::apiResource('grades', GradeController::class);

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/users/me', [UserController::class, 'me']);
