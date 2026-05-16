<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $faqs = Faq::all();
        return response()->json($faqs);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $faq = Faq::create($request->only(['question', 'answer']));
         return response()->json($faq, 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $faq = Faq::find($id);
    
    if (!$faq) {
        return response()->json([
            'success' => false,
            'message' => 'FAQ not found'
        ], 404);
    }
    
    return response()->json([
        'success' => true,
        'data' => $faq,  // Wrap in 'data' property
        'message' => 'FAQ retrieved successfully'
    ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
   public function edit(string $id)
{
    
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $faq = Faq::find($id);
        if (!$faq) {
            return response()->json(['message' => 'FAQ not found'], 404);
        }
        $faq->update($request->only(['question', 'answer']));
        return response()->json($faq);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

        $faq = Faq::find($id);
        if (!$faq) {
            return response()->json(['message' => 'FAQ not found'], 404);
        }
        $faq->delete();
        return response()->json(['message' => 'FAQ deleted successfully']);
    }
}
