<?php

use App\Http\Controllers\Api\AdminDashboardController;
use App\Http\Controllers\Api\AnnouncementController;
use App\Http\Controllers\Api\AssessmentController;
use App\Http\Controllers\Api\AssignAssessmentController;
use App\Http\Controllers\Api\AssignmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BatchController;
use App\Http\Controllers\Api\ClassScheduleController;
use App\Http\Controllers\Api\CouponController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\CourseCurriculumController;
use App\Http\Controllers\Api\CourseInstructorController;
use App\Http\Controllers\Api\CoursesByStudentController;
use App\Http\Controllers\Api\FaqController;
use App\Http\Controllers\Api\InstructorController;
use App\Http\Controllers\Api\McqController;
use App\Http\Controllers\Api\PolicyController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\GuardianController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\QuizAttemptController;
use App\Http\Controllers\Api\QuizController;
use App\Http\Controllers\Api\AssessmentAttemptController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\Api\AssignmentAttemptController;
use App\Http\Controllers\Api\ResultController;
use App\Http\Controllers\Api\GradeController;
use App\Http\Controllers\Api\GuardianDashboardController;
use App\Http\Controllers\Api\InstructorDashboardController;
use App\Http\Controllers\Api\StudentDashboardController;
use App\Http\Controllers\Api\RolePermissionController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\SettingController;
use App\Models\Student;


// Public routes
Route::post('admin/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Protected routes
Route::middleware('auth:sanctum')->prefix('admin')->group(function () {

    Route::get('/dashboard', [AdminDashboardController::class, 'getStats']);

Route::put('/reset-password', [AdminDashboardController::class, 'resetPassword']);


    Route::get('/bills', [OrderController::class, 'adminIndex']);
    Route::get('/bills/{orderId}', [OrderController::class, 'adminShow']);

     Route::get('/settings', [SettingController::class, 'getSettings']);
    Route::post('/settings', [SettingController::class, 'saveSettings']);

// SEO Settings
    Route::get('/seo-settings', [SettingController::class, 'getSeoSettings']);
    Route::post('/seo-settings', [SettingController::class, 'saveSeoSettings']);
    Route::get('/grade-history/courses', [GradeController::class, 'adminCourses']);
    Route::get('/grade-history/courses/{courseId}/batches', [GradeController::class, 'batchesByCourse']);
    Route::get('/grade-history/courses/{courseId}/batches/{batchId}/students', [GradeController::class, 'batchStudents']);
    Route::get('/grade-history/courses/{courseId}/students/{studentId}', [GradeController::class, 'studentDetail']);

    Route::get('/assessments/queries', [HomeController::class, 'Assessmentindex']);
    Route::get('/assessments/course/{course}', [AssessmentController::class, 'getByCourse']);
    Route::get('assessments/{id}/', [HomeController::class, 'getAssessmentsForAppointment']);

    Route::get('/quiz-attempts', [QuizAttemptController::class, 'attemptedList']);
    Route::get('/quiz-attempts/{attemptId}', [QuizAttemptController::class, 'attemptDetail']);
    Route::post('/quiz-attempts/{attemptId}/check', [QuizAttemptController::class, 'checkQuiz']);

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('faqs', FaqController::class);
    Route::apiResource('instructors', InstructorController::class);
    Route::apiResource('courses', CourseController::class);
    Route::apiResource('course-instructor', CourseInstructorController::class);
    Route::apiResource('course-curriculam', CourseCurriculumController::class);
    Route::apiResource('policies', PolicyController::class);
    Route::apiResource('assignments', AssignmentController::class);
    Route::apiResource('coupons', CouponController::class);
    Route::apiResource('mcqs', McqController::class);
    Route::apiResource('assessments', AssessmentController::class);
    Route::get('/announcements/instructors', [AnnouncementController::class, 'getInstructors']);
    Route::get('/announcements/courses', [AnnouncementController::class, 'getCourses']);
    Route::get('/announcements/batches/{courseId}', [AnnouncementController::class, 'getBatches']);

    Route::apiResource('students', StudentController::class);



    Route::post('assign-assessments', [AssignAssessmentController::class, 'store']);

    Route::get('/batches/course/{courseId}', [BatchController::class, 'getBatchesByCourse']);
    // Quiz specific routes — pehle
    Route::get('/quizzes/course/{courseId}/mcqs', [QuizController::class, 'getMcqsByCourse']);
    Route::post('/quiz-attempts/batch-status', [QuizAttemptController::class, 'batchStudentStatus']);

    Route::apiResource('quizzes', QuizController::class);

// Assignment Attempts — Admin
Route::post('/assignment-attempts/batch-status', [AssignmentAttemptController::class, 'batchStudentStatus']);
Route::get('/assignment-attempts/{attemptId}', [AssignmentAttemptController::class, 'attemptDetailForGrading']);
Route::post('/assignment-attempts/{attemptId}/grade', [AssignmentAttemptController::class, 'gradeAttempt']);
    Route::apiResource('batches', BatchController::class);
    Route::get('announcements/instructors', [AnnouncementController::class, 'getInstructors']);
    Route::get('announcements/courses',     [AnnouncementController::class, 'getCourses']);
    Route::get('/instructors/{id}/courses', [CourseController::class, 'CoursesByInstructor']);
    Route::get('/courses/{id}/students', [CoursesByStudentController::class, 'getstudents']);
    Route::apiResource('announcements', AnnouncementController::class);


    Route::middleware('auth:sanctum')->prefix('students')->group(function(){
        Route::get('/', [StudentController::class, 'index']); // list all
        Route::post('/register', [StudentController::class, 'Register']); // admin add
        Route::put('/{id}', [StudentController::class, 'update']); // edit
        Route::delete('/{id}', [StudentController::class, 'destroy']); // delete
    });

    Route::get('assign-assessments', [AssignAssessmentController::class, 'index']);
    Route::get('assign-assessments/{id}', [AssignAssessmentController::class, 'show']);
    Route::put('assign-assessments/{id}', [AssignAssessmentController::class, 'update']);
    Route::delete('assign-assessments/{id}', [AssignAssessmentController::class, 'destroy']);

    Route::get('assessment-attempts', [AssessmentAttemptController::class, 'index']);
    Route::get('assessment-attempts/{id}', [AssessmentAttemptController::class, 'show']);
    Route::put('assessment-attempts/{id}/grade', [AssessmentAttemptController::class, 'grade']);

    Route::get('/guardians', [GuardianController::class, 'Adminindex']);



    Route::get('/roles', [RolePermissionController::class, 'index']);
    Route::get('/permissions', [RolePermissionController::class, 'allPermissions']);
    Route::post('/roles/{role}/permissions', [RolePermissionController::class, 'updateRolePermissions']);
    Route::get('/users-list', [RolePermissionController::class, 'users']);
    Route::post('/users/{user}/assign-role', [RolePermissionController::class, 'assignRole']);
    Route::post('/users/create', [RolePermissionController::class, 'createUser']);
     Route::apiResource('roles-manage', RoleController::class);

});

// Guardian routes ----------------- //
Route::post('guardian/login', [AuthController::class, 'Guardianlogin']);
Route::post('/guardian/logout', [AuthController::class, 'Guardianlogout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->prefix('guardian')->group(function () {
    // GET /api/guardian -> returns currently authenticated guardian's profile
    Route::get('/', [GuardianController::class, 'index']);
    Route::get('/dashboard', [GuardianDashboardController::class, 'getStats']);
    Route::get('/my-bills', [OrderController::class, 'guardianIndex']);
     Route::get('/grade-history/courses', [GradeController::class, 'guardianCourses']);
    Route::put('profile/update', [GuardianController::class, 'update']);
    Route::get('assessments', [AssignAssessmentController::class, 'getGuardianAssessments']);
    Route::get('courses', [CourseController::class, 'guardianIndex']);
    Route::get('courses/{id}', [CourseController::class, 'show']);
    Route::get('students', [GuardianController::class, 'getGuardianStudents']);
    Route::get('checkout/guardian', [GuardianController::class, 'getGuardianStudents']);
    Route::post('validate-coupon', [OrderController::class, 'validateCoupon']);
    Route::post('orders', [OrderController::class, 'GuardianOrderstore']);
    Route::get('orders', [OrderController::class, 'index']);
    Route::get('orders/{id}', [OrderController::class, 'show']);
    Route::get('student-courses/{student_id}', [CoursesByStudentController::class, 'getCoursesByStudentForGuardian']);
    Route::get('courses/{courseId}/batches', [BatchController::class, 'getBatchesByCourse']);
    Route::get('batches/{batchId}/schedule', [ClassScheduleController::class, 'getByBatch']);
     Route::get('results/courses/{studentId}',            [ResultController::class, 'guardianStudentCourses']);
    Route::get('results/quiz/{studentId}/{courseId}',    [ResultController::class, 'guardianQuizResults']);
    Route::get('results/assignment/{studentId}/{courseId}', [ResultController::class, 'guardianAssignmentResults']);
Route::get('student/{studentId}/schedules', [ClassScheduleController::class, 'getSchedulesByStudentId']);
Route::post('/reset-password', [GuardianController::class, 'resetPassword']);
});

// Student routes ----------------- //

Route::post('student/login', [AuthController::class, 'Studentlogin']);
Route::post('/student/logout', [AuthController::class, 'Studentlogout'])->middleware('auth:student');

Route::middleware('auth:sanctum')->prefix('student')->group(function () {
    Route::get('/dashboard', [StudentDashboardController::class, 'getStats']);
Route::get('/my-bills', [OrderController::class, 'studentIndex']);
    // Profile
    Route::get('/profile', [StudentController::class, 'profile']);
    Route::put('/profile', [StudentController::class, 'updateProfile']);

    Route::post('/reset-password', [StudentController::class, 'resetPassword']);

    Route::get('check-assessment/{studentId}/{courseId}', [CourseController::class, 'checkAssessmentCompletion']);
    Route::post('enroll-course', [CourseController::class, 'enrollStudent']);
 Route::get('/assignments/course/{id}', [AssignmentController::class, 'getAssignmentsByCourseId']);
Route::get('/assignment-attempts/check/{assignmentId}', [AssignmentAttemptController::class, 'checkAttempt']);

Route::post('/assignment-attempts/submit/{assignmentId}', [AssignmentAttemptController::class, 'submit']);
Route::get('/assignment-attempts/my', [AssignmentAttemptController::class, 'myAttempts']);

Route::get('/results/courses', [ResultController::class, 'myCourses']);
 Route::get('/student-courses', [ClassScheduleController::class, 'getStudentCourses']);
   Route::get('/courses/{courseId}/schedules', [ClassScheduleController::class, 'getStudentSchedulesByCourse']);

Route::get('/results/quiz/{courseId}', [ResultController::class, 'quizResults']);
Route::get('/quiz-attempts/result/{attemptId}', [QuizAttemptController::class, 'studentResult']);
Route::get('/results/assignment/{courseId}', [ResultController::class, 'assignmentResults']);
      // Quiz Attempt routes — specific pehle
    Route::get('/quiz-attempts/check/{quizId}', [QuizAttemptController::class, 'checkAttempt']);
    Route::post('/quiz-attempts/start/{quizId}', [QuizAttemptController::class, 'startQuiz']);
    Route::get('/quiz-attempts/resume/{quizId}', [QuizAttemptController::class, 'getResumeData']);
    Route::post('/quiz-attempts/submit/{attemptId}', [QuizAttemptController::class, 'submitQuiz']);
    Route::post('/quiz-attempts/save-progress/{attemptId}', [QuizAttemptController::class, 'saveProgress']);
    Route::get('/quiz-attempts/my', [QuizAttemptController::class, 'myAttempts']);

    Route::post('/register', [StudentController::class, 'register']);
    Route::get('/check-email/{email}', [StudentController::class, 'checkEmailExists']);
    Route::get('/check-username/{username}', [StudentController::class, 'checkUsernameExists']);

    Route::get('/my-assessments', [AssignAssessmentController::class, 'getStudentAssessments']);
    Route::get('/assessment-check-attempt/{assignId}', [AssessmentAttemptController::class, 'checkAttempt']);
    Route::post('/assessment-start/{assignId}', [AssessmentAttemptController::class, 'startAssessment']);
    Route::post('/assessment-submit/{attemptId}', [AssessmentAttemptController::class, 'submitAssessment']);
    Route::get('/assessment-my-attempts', [AssessmentAttemptController::class, 'myAttempts']);

    Route::get('/assessment-view/{assignAssessmentId}', [AssessmentAttemptController::class, 'studentViewAttempt']);
  Route::post('assessment-save-progress/{attemptId}', [AssessmentAttemptController::class, 'saveProgress']);
   Route::get('/assessment-my-results', [AssessmentAttemptController::class, 'myResults']);






    // Courses
    Route::get('/courses', [CourseController::class, 'studentIndex']);
    Route::get('/courses/{id}', [CourseController::class, 'show']);

    Route::get('/my-courses', [CoursesByStudentController::class, 'myEnrolledCourses']);
    Route::get('/my-courses/{id}', [CoursesByStudentController::class, 'show']);
    // Route::get('/assignments/course/{courseId}', [AssignmentController::class, 'getAssignmentsByCourse']);
    Route::get('/assignments/batch/{batchId}', [AssignmentController::class, 'getAssignmentsByCourse']);
    Route::get('/courses/{courseId}/batches', [BatchController::class, 'getBatchesByCourse']);
    Route::get('/class-schedules/batch/{batchId}', [ClassScheduleController::class, 'getByBatch']);

    // Orders & Coupon (specific - pehle)
    Route::post('/coupon/validate', [OrderController::class, 'validateCoupon']);
    Route::post('/orders', [OrderController::class, 'store']);
    Route::post('create-payment-intent', [OrderController::class, 'createPaymentIntent']);
    Route::post('{orderId}/refund', [OrderController::class, 'refundOrder']);
    Route::post('{orderId}/cancel', [OrderController::class, 'cancelOrder']);
    Route::get('{orderId}/payment-status', [OrderController::class, 'getPaymentStatus']);
    Route::post('orders/verify-payment', [OrderController::class, 'verifyPayment']); // Add this line
    Route::get('/orders', [OrderController::class, 'index']);
    Route::get('/orders/{id}', [OrderController::class, 'show']);
    Route::get('/quizzes/batch/{batchId}', [QuizController::class, 'getByBatch']);

    // Education & Guardian sub-routes
    Route::get('/{studentId}/education', [StudentController::class, 'getStudentDetails']);
    Route::get('/{studentId}/guardian', [StudentController::class, 'getGuardian']);

    // Generic (baad mein - warna sab match ho jata)
    Route::get('/{id}', [StudentController::class, 'show']);
    Route::put('/{id}', [StudentController::class, 'update']);

    // Protected routes (require authentication)
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/{id}', [StudentController::class, 'show']);
        Route::put('/{id}', [StudentController::class, 'update']);
        Route::get('/{studentId}/education', [StudentController::class, 'getStudentDetails']);
        Route::get('/{studentId}/guardian', [StudentController::class, 'getGuardian']);
    });


});

// Student Registration Routes
// Route::prefix('students')->group(function () {

// });

// Instructor routes ----------------- //
Route::post('instructor/login', [AuthController::class, 'instructorLogin']);
Route::post('/instructor/logout', [AuthController::class, 'logout'])->middleware('auth:instructor');

Route::middleware('auth:sanctum')->prefix('instructor')->group(function () {
    // GET /api/instructor -> returns currently authenticated instructor's profile
    Route::get('/', [InstructorController::class, 'index']);
    Route::get('/dashboard', [InstructorDashboardController::class, 'getStats']);

Route::put('/reset-password', [InstructorController::class, 'resetPassword']);
    Route::get('/grade-history/courses', [GradeController::class, 'instructorCourses']);
Route::get('/grade-history/courses/{courseId}/batches', [GradeController::class, 'batchesByCourse']);
Route::get('/grade-history/courses/{courseId}/batches/{batchId}/students', [GradeController::class, 'batchStudents']);
Route::get('/grade-history/courses/{courseId}/students/{studentId}', [GradeController::class, 'studentDetail']);

    //assignment routes
    Route::get('/assignments', [AssignmentController::class, 'instructorIndex']);
Route::get('/assignments/{id}', [AssignmentController::class, 'show']);
Route::post('/assignments', [AssignmentController::class, 'store']);
Route::post('/assignments/{id}', [AssignmentController::class, 'update']); // POST for file upload
Route::delete('/assignments/{id}', [AssignmentController::class, 'destroy']);
// Assignment Attempts — Instructor
Route::post('/assignment-attempts/batch-status', [AssignmentAttemptController::class, 'batchStudentStatus']);
Route::get('/assignment-attempts/{attemptId}', [AssignmentAttemptController::class, 'attemptDetailForGrading']);
Route::post('/assignment-attempts/{attemptId}/grade', [AssignmentAttemptController::class, 'gradeAttempt']);
    // MCQ routes
    Route::get('/mcqs', [McqController::class, 'instructorIndex']);
    Route::get('/mcqs/{id}', [McqController::class, 'show']);
    Route::post('/mcqs', [McqController::class, 'store']);
    Route::put('/mcqs/{id}', [McqController::class, 'update']);
    Route::delete('/mcqs/{id}', [McqController::class, 'destroy']);

    Route::get('/quiz-attempts', [QuizAttemptController::class, 'attemptedList']);
    Route::get('/quiz-attempts/{attemptId}', [QuizAttemptController::class, 'attemptDetail']);
    Route::post('/quiz-attempts/{attemptId}/check', [QuizAttemptController::class, 'checkQuiz']);

    // Quiz routes
    Route::get('/quizzes/course/{courseId}/mcqs', [QuizController::class, 'getMcqsByCourse']);
    Route::post('/quiz-attempts/batch-status', [QuizAttemptController::class, 'batchStudentStatus']);
    Route::get('/quizzes', [QuizController::class, 'instructorIndex']);
    Route::get('/quizzes/{id}', [QuizController::class, 'show']);
    Route::post('/quizzes', [QuizController::class, 'store']);
    Route::put('/quizzes/{id}', [QuizController::class, 'update']);
    Route::delete('/quizzes/{id}', [QuizController::class, 'destroy']);
    Route::put('profile/update', [InstructorController::class, 'update']);
    Route::get('courses', [CourseController::class, 'instructorIndex']);
    Route::get('courses/{id}', [CourseController::class, 'show']);
    // Profile
    Route::get('/profile', [InstructorController::class, 'profile']);
    Route::put('/profile', [InstructorController::class, 'updateProfile']);

    Route::get('/courses', [CourseController::class, 'InstructorIndex']);
    Route::get('/courses/{id}', [CourseController::class, 'show']);

    Route::get('/instructors', [InstructorController::class, 'index']);

    Route::apiResource('class-schedules', ClassScheduleController::class);
    Route::get('/class-schedules/batch/{batchId}', [ClassScheduleController::class, 'getByBatch']);

    Route::put('/class-schedules/multiple/{id}', [ClassScheduleController::class, 'updateMultiple']); // For updating multiple

    Route::delete('/class-schedules', [ClassScheduleController::class, 'destroyMultiple']); // Delete multiple
    Route::get('/courses/{courseId}/batches', [BatchController::class, 'getBatchesByCourse']);

    Route::get('/announcements/courses', [AnnouncementController::class, 'instructorCourses']);
    Route::get('/announcements/courses/{courseId}/batches', [AnnouncementController::class, 'getBatchesByCourse']);
    Route::get('/announcements/courses/{courseId}/students-count', [AnnouncementController::class, 'getCourseStudentsCount']);
    Route::get('/announcements', [AnnouncementController::class, 'instructorIndex']);
    Route::post('/announcements', [AnnouncementController::class, 'instructorStore']);
    Route::get('/announcements/{id}', [AnnouncementController::class, 'instructorShow']);
    Route::put('/announcements/{id}', [AnnouncementController::class, 'instructorUpdate']);
    Route::delete('/announcements/{id}', [AnnouncementController::class, 'destroy']);

    Route::get('announcements/batches/{courseId}', [AnnouncementController::class, 'getBatches']);

    Route::get('/students', [StudentController::class, 'InstructorIndex']);
    Route::get('/batches', [BatchController::class, 'InstructorIndex']);
});

Route::prefix('guest')->group(function () {
    Route::get('guest-assessments', [AssignAssessmentController::class, 'getGuestAssessments']);
    Route::get('assessment-check-attempt/{assignId}',  [AssessmentAttemptController::class, 'checkGuestAttempt']);
    Route::post('assessment-start/{assignId}',         [AssessmentAttemptController::class, 'guestStartAssessment']);
    Route::post('assessment-submit/{attemptId}',       [AssessmentAttemptController::class, 'guestSubmitAssessment']);
     Route::get('assessment-view/{assignAssessmentId}', [AssessmentAttemptController::class, 'guestViewAttempt']);
     Route::get('assessment-my-results', [AssessmentAttemptController::class, 'guestMyResults']);
      Route::post('assessment-submit/{attemptId}',       [AssessmentAttemptController::class, 'guestSubmitAssessment']);
Route::post('assessment-save-progress/{attemptId}', [AssessmentAttemptController::class, 'guestSaveProgress']);
});
