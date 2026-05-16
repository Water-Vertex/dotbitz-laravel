<?php




namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CourseCurriculum;
use Illuminate\Http\Request;

class CourseCurriculumController extends Controller
{
    public function index(Request $request)
    {
        $query = CourseCurriculum::with('course');

        if ($request->has('course_id')) {
            $query->where('course_id', $request->course_id);
        }

        $curricula = $query->orderBy('sorting_order')->get();

        return response()->json([
            'success' => true,
            'data' => $curricula
        ]);
    }

    /**
     * Store one OR multiple curriculum items at once.
     *
     * Accepts either:
     *   { course_id, items: [ { title, duration, description }, ... ] }
     * OR a single flat object:
     *   { course_id, title, duration, description }
     */
    public function store(Request $request)
    {
        $request->validate([
        'course_id'              => 'required|exists:courses,id',
        'items'                  => 'sometimes|array|min:1',
        'items.*.title'          => 'required_with:items|string|max:255',
        'items.*.duration'       => 'nullable|string|max:50',  
        'items.*.description'    => 'nullable|string',
        'items.*.sorting_order'  => 'nullable|integer',
        'title'                  => 'required_without:items|string|max:255',
        'duration'               => 'nullable|string|max:50',  
        'description'            => 'nullable|string',
        'sorting_order'          => 'nullable|integer',
        ]);

        $courseId = $request->course_id;

        // ---- Bulk insert ----
        if ($request->has('items') && is_array($request->items)) {
            $created = [];
            foreach ($request->items as $item) {
                $created[] = CourseCurriculum::create([
                    'course_id'     => $courseId,
                    'title'         => $item['title'],
                    'duration'      => $item['duration'] ?? null,
                    'description'   => $item['description'] ?? null,
                    'sorting_order' => $item['sorting_order'] ?? null,
                ]);
            }

            return response()->json([
                'success' => true,
                'data'    => collect($created)->map->load('course'),
                'message' => count($created) . ' curriculum item(s) created successfully',
            ], 201);
        }

        // ---- Single insert ----
        $curriculum = CourseCurriculum::create([
            'course_id'     => $courseId,
            'title'         => $request->title,
            'duration'      => $request->duration,
            'description'   => $request->description,
            'sorting_order' => $request->sorting_order,
        ]);

        return response()->json([
            'success' => true,
            'data'    => $curriculum->load('course'),
            'message' => 'Course curriculum created successfully',
        ], 201);
    }

    public function show(string $id)
    {
        $curriculum = CourseCurriculum::with('course')->find($id);

        if (!$curriculum) {
            return response()->json([
                'success' => false,
                'message' => 'Curriculum not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $curriculum
        ]);
    }

    public function update(Request $request, string $id)
    {
        $curriculum = CourseCurriculum::find($id);

        if (!$curriculum) {
            return response()->json([
                'success' => false,
                'message' => 'Curriculum not found'
            ], 404);
        }

        $request->validate([
            'title'         => 'sometimes|required|string|max:255',
             'duration'      => 'nullable|string|max:50',  
            'description'   => 'nullable|string',
            'sorting_order' => 'nullable|integer',
        ]);

        $curriculum->update($request->only(['title', 'duration', 'description', 'sorting_order']));

        return response()->json([
            'success' => true,
            'data'    => $curriculum->load('course'),
            'message' => 'Curriculum updated successfully',
        ]);
    }

    public function destroy(string $id)
    {
        $curriculum = CourseCurriculum::find($id);

        if (!$curriculum) {
            return response()->json([
                'success' => false,
                'message' => 'Curriculum not found'
            ], 404);
        }

        $curriculum->delete();

        return response()->json([
            'success' => true,
            'message' => 'Curriculum deleted successfully',
        ]);
    }
}