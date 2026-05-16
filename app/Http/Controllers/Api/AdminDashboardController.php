<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AssessmentQuery;
use App\Models\Guardian;
use App\Models\Instructor;
use App\Models\Student;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    //
    public function getStats()
    {
        $totalStudents = Student::count();
        $totalInstructors = Instructor::count();
        $totalGuardians = Guardian::count();
        $totalAssessmentsQueries = AssessmentQuery::count();

        return response()->json([
            'success' => true,
            'data' => [
                'total_students' => $totalStudents,
                'total_instructors' => $totalInstructors,
                'total_guardians' => $totalGuardians,
                'total_assessments_queries' => $totalAssessmentsQueries,
            ],
        ]);
    }
}
