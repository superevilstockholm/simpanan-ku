<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\Auth\AuthController;

// Master Data
use App\Http\Controllers\MasterData\UserController;
use App\Http\Controllers\MasterData\DataClassesController;
use App\Http\Controllers\MasterData\DataStudentController;
use App\Http\Controllers\MasterData\DataTeacherController;

// Auth
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::middleware('role:admin')->group(function () {
        // Master Data
        Route::apiResource('data-users', UserController::class)->parameters([
            'data-users' => 'user'
        ]);
        Route::apiResource('data-classes', DataClassesController::class)->parameters([
            'data-classes' => 'dataClasses'
        ]);
        Route::apiResource('data-students', DataStudentController::class)->parameters([
            'data-students' => 'dataStudent'
        ]);
        Route::apiResource('data-teachers', DataTeacherController::class)->parameters([
            'data-teachers' => 'dataTeacher'
        ]);
    });
});
