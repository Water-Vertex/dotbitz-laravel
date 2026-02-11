<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Policy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $policies = Policy::all();

        return response()->json($policies);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    $validated = $request->validate([
        'title' => 'required|string|min:2',
        'description' => 'required|string|min:2',
        'meta_title' => 'nullable|string',
        'meta_keywords' => 'nullable|string',
        'meta_tags' => 'nullable|string',
        'meta_description' => 'nullable|string'
    ]);

    DB::beginTransaction();

    try {
        $validated['slug'] = Str::slug($request->title);
        $policy = Policy::create($validated);


        DB::commit();

        return response()->json([
            'success' => true,
            'data' => $policy,
            'message' => 'Policy saved successfully'
        ]);

    } catch (\Exception $e) {
        DB::rollBack();

        return response()->json([
            'success' => false,
            'message' => 'Failed to save policy',
            'error' => $e->getMessage()
        ], 500);
    }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
         $policy = Policy::find($id);

        if (!$policy) {
            return response()->json([
                'success' => false,
                'message' => 'Policy not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $policy,  // Wrap in 'data' property
            'message' => 'Policy retrieved successfully'
        ]);
        }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $policy = Policy::find($id);

        if (!$policy) {
            return response()->json([
                'success' => false,
                'message' => 'Policy not found'
            ], 404);
        }

        $validated = $request->validate([
            'title' => 'required|string|min:2',
            'description' => 'required|string|min:2',
            'meta_title' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'meta_tags' => 'nullable|string',
            'meta_description' => 'nullable|string'
        ]);




        $validated['slug'] = Str::slug($request->title);
        $policy->update($validated);

        return response()->json($policy);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Policy::findOrFail($id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Policy deleted successfully'
        ]);
    }
}
