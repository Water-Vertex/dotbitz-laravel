<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CourseController;
use App\Http\Controllers\Api\FaqController;
use App\Http\Controllers\Api\InstructorController;

// Public routes
Route::post('/login', [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('faqs', FaqController::class);
    Route::apiResource('instructors', InstructorController::class);
    Route::apiResource('courses', CourseController::class);
});

