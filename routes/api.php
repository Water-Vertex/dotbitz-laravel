<?php

use App\Http\Controllers\Api\AssessmentController;
use App\Http\Controllers\Api\AssignmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CouponController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\CourseCurriculumController;
use App\Http\Controllers\Api\FaqController;
use App\Http\Controllers\Api\InstructorController;
use App\Http\Controllers\Api\McqController;
use App\Http\Controllers\Api\PolicyController;
use App\Http\Controllers\Api\StudentController;


// Public routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('faqs', FaqController::class);
    Route::apiResource('instructors', InstructorController::class);
    Route::apiResource('courses', CourseController::class);
    Route::apiResource('course-curriculam', CourseCurriculumController::class);
    Route::apiResource('policies', PolicyController::class);
    Route::apiResource('assignments', AssignmentController::class);
    Route::apiResource('coupons', CouponController::class);
    Route::apiResource('mcqs', McqController::class);
    Route::apiResource('assessments', AssessmentController::class);

});


// Student Registration Routes
Route::prefix('students')->group(function () {
    Route::post('/register', [StudentController::class, 'register']);
    Route::get('/check-email/{email}', [StudentController::class, 'checkEmailExists']);
    Route::get('/check-username/{username}', [StudentController::class, 'checkUsernameExists']);

    // Protected routes (require authentication)
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/{id}', [StudentController::class, 'show']);
        Route::put('/{id}', [StudentController::class, 'update']);
        Route::get('/{studentId}/education', [StudentController::class, 'getStudentDetails']);
        Route::get('/{studentId}/guardian', [StudentController::class, 'getGuardian']);
    });

    Route::middleware('auth:sanctum')->prefix('admin/students')->group(function(){
        Route::get('/', [StudentController::class, 'index']); // list all
        Route::post('/add', [StudentController::class, 'adminRegister']); // admin add
        Route::put('/{id}', [StudentController::class, 'update']); // edit
        Route::delete('/{id}', [StudentController::class, 'destroy']); // delete
    });
});

