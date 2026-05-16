<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Student;
use App\Models\Guardian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    // ===== PUBLIC — website p approved reviews =====

    public function publicReviews(Request $request)
    {
        $query = Review::with('course')
            ->where('status', 'approved')
            ->orderBy('created_at', 'desc');

        if ($request->has('course_id') && $request->course_id) {
            $query->where('course_id', $request->course_id);
        }

        $reviews = $query->get()->map(fn($r) => $this->format($r));

        // Rating stats
        $stats = $this->getStats($request->course_id);

        return response()->json([
            'success' => true,
            'data'    => $reviews,
            'stats'   => $stats,
        ]);
    }

    private function getStats($courseId = null): array
    {
        $query = Review::where('status', 'approved');
        if ($courseId) $query->where('course_id', $courseId);

        $total   = $query->count();
        $average = $total > 0 ? round($query->avg('rating'), 1) : 0;

        $distribution = [];
        for ($i = 5; $i >= 1; $i--) {
            $count = (clone $query)->where('rating', $i)->count();
            $distribution[$i] = [
                'count'   => $count,
                'percent' => $total > 0 ? round(($count / $total) * 100) : 0,
            ];
        }

        return [
            'total'        => $total,
            'average'      => $average,
            'distribution' => $distribution,
        ];
    }

    private function format(Review $review): array
    {
        return [
            'id'            => $review->id,
            'reviewer_name' => $review->reviewer_name,
            'rating'        => $review->rating,
            'review'        => $review->review,
            'course_id'     => $review->course_id,
            'course_name'   => $review->course?->course_name,
            'status'        => $review->status,
            'user_type'     => $review->user_type,
            'created_at'    => $review->created_at?->format('M d, Y'),
        ];
    }

    // ===== STUDENT =====

    public function studentIndex()
    {
        $user    = Auth::user();
        $student = Student::where('email', $user->email)->first();

        $reviews = Review::where('user_id', $student?->id ?? $user->id)
            ->where('user_type', 'student')
            ->with('course')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(fn($r) => $this->format($r));

        return response()->json(['success' => true, 'data' => $reviews]);
    }

    public function studentStore(Request $request)
    {
        $user    = Auth::user();
        $student = Student::where('email', $user->email)->first();

        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'rating'    => 'required|integer|min:1|max:5',
            'review'    => 'required|string|max:1000',
        ]);

        // Duplicate check
        $exists = Review::where('user_id', $student?->id ?? $user->id)
            ->where('user_type', 'student')
            ->where('course_id', $request->course_id)
            ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'You have already reviewed this course.',
            ], 409);
        }

        $review = Review::create([
            'user_id'       => $student?->id ?? $user->id,
            'user_type'     => 'student',
            'course_id'     => $request->course_id,
            'rating'        => $request->rating,
            'review'        => $request->review,
            'reviewer_name' => trim(($student?->first_name ?? '') . ' ' . ($student?->last_name ?? '')),
            'status'        => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Review submitted. It will appear after approval.',
            'data'    => $this->format($review),
        ], 201);
    }

    public function studentDestroy($id)
    {
        $user    = Auth::user();
        $student = Student::where('email', $user->email)->first();

        $review = Review::where('id', $id)
            ->where('user_id', $student?->id ?? $user->id)
            ->where('user_type', 'student')
            ->first();

        if (!$review) {
            return response()->json(['success' => false, 'message' => 'Review not found.'], 404);
        }

        $review->delete();
        return response()->json(['success' => true, 'message' => 'Review deleted.']);
    }

    // ===== GUARDIAN =====

    public function guardianIndex()
    {
        $user     = Auth::user();
        $guardian = Guardian::where('email', $user->email)->first();

        $reviews = Review::where('user_id', $guardian?->id ?? $user->id)
            ->where('user_type', 'guardian')
            ->with('course')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(fn($r) => $this->format($r));

        return response()->json(['success' => true, 'data' => $reviews]);
    }

    public function guardianStore(Request $request)
    {
        $user     = Auth::user();
        $guardian = Guardian::where('email', $user->email)->first();

        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'rating'    => 'required|integer|min:1|max:5',
            'review'    => 'required|string|max:1000',
        ]);

        $exists = Review::where('user_id', $guardian?->id ?? $user->id)
            ->where('user_type', 'guardian')
            ->where('course_id', $request->course_id)
            ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'You have already reviewed this course.',
            ], 409);
        }

        $review = Review::create([
            'user_id'       => $guardian?->id ?? $user->id,
            'user_type'     => 'guardian',
            'course_id'     => $request->course_id,
            'rating'        => $request->rating,
            'review'        => $request->review,
            'reviewer_name' => trim(($guardian?->first_name ?? '') . ' ' . ($guardian?->last_name ?? '')),
            'status'        => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Review submitted. It will appear after approval.',
            'data'    => $this->format($review),
        ], 201);
    }

    public function guardianDestroy($id)
    {
        $user     = Auth::user();
        $guardian = Guardian::where('email', $user->email)->first();

        $review = Review::where('id', $id)
            ->where('user_id', $guardian?->id ?? $user->id)
            ->where('user_type', 'guardian')
            ->first();

        if (!$review) {
            return response()->json(['success' => false, 'message' => 'Review not found.'], 404);
        }

        $review->delete();
        return response()->json(['success' => true, 'message' => 'Review deleted.']);
    }

    // ===== ADMIN =====

    public function adminIndex(Request $request)
    {
        $query = Review::with('course')->orderBy('created_at', 'desc');

        if ($request->has('status') && $request->status) {
            $query->where('status', $request->status);
        }
        if ($request->has('course_id') && $request->course_id) {
            $query->where('course_id', $request->course_id);
        }

        $reviews = $query->get()->map(fn($r) => $this->format($r));

        return response()->json(['success' => true, 'data' => $reviews]);
    }

    public function adminUpdateStatus(Request $request, $id)
    {
        $review = Review::find($id);
        if (!$review) {
            return response()->json(['success' => false, 'message' => 'Review not found.'], 404);
        }

        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $review->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => 'Review status updated.',
            'data'    => $this->format($review->fresh()),
        ]);
    }

    public function adminDestroy($id)
    {
        $review = Review::find($id);
        if (!$review) {
            return response()->json(['success' => false, 'message' => 'Review not found.'], 404);
        }

        $review->delete();
        return response()->json(['success' => true, 'message' => 'Review deleted.']);
    }
}