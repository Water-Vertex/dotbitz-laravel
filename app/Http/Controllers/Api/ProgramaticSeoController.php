<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProgramaticSeo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ProgramaticSeoController extends Controller
{
    // GET all records
    public function index()
    {
        $programaticSeos = ProgramaticSeo::all();
        return response()->json([
            'success' => true,
            'data' => $programaticSeos
        ]);
    }

    // GET single record
    public function show($id)
    {
        $programaticSeo = ProgramaticSeo::find($id);
        if (!$programaticSeo) {
            return response()->json([
                'success' => false,
                'message' => 'Record not found'
            ], 404);
        }
        return response()->json([
            'success' => true,
            'data' => $programaticSeo
        ]);
    }

    // UPDATE record
    public function update(Request $request, $id)
    {
        $programaticSeo = ProgramaticSeo::find($id);
        if (!$programaticSeo) {
            return response()->json([
                'success' => false,
                'message' => 'Record not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'focus_keyword' => 'nullable|string',
            'content' => 'nullable|string',
            'image' => 'nullable|string',
            'image_alt' => 'nullable|string',
            'h1_heading' => 'nullable|string',
            'faqs' => 'nullable|string',
            'section_content_left' => 'nullable|string',
            'section_content_right' => 'nullable|string',
            'image_left' => 'nullable|string',
            'image_right' => 'nullable|string',
            'image_left_alt' => 'nullable|string',
            'image_right_alt' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $programaticSeo->update($request->all());
        
        return response()->json([
            'success' => true,
            'message' => 'Record updated successfully',
            'data' => $programaticSeo
        ]);
    }

    // DELETE record
    public function destroy($id)
    {
        $programaticSeo = ProgramaticSeo::find($id);
        if (!$programaticSeo) {
            return response()->json([
                'success' => false,
                'message' => 'Record not found'
            ], 404);
        }

        $programaticSeo->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Record deleted successfully'
        ]);
    }

    // IMPORT CSV/EXCEL (exactly like your reference code)
    // public function import(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'csv_file' => 'required|file|mimes:csv,xls,xlsx,txt|max:5120',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'success' => false,
    //             'errors' => $validator->errors()
    //         ], 422);
    //     }

    //     $path = $request->file('csv_file')->getRealPath();
    //     $extension = $request->file('csv_file')->getClientOriginalExtension();
        
    //     $rows = [];

    //     if (in_array($extension, ['xls', 'xlsx'])) {
    //         $spreadsheet = IOFactory::load($path);
    //         $sheet = $spreadsheet->getActiveSheet();
    //         $rows = $sheet->toArray(null, true, true, true);
    //     } else {
    //         if (($handle = fopen($path, 'r')) !== false) {
    //             while (($data = fgetcsv($handle, 10000, ',')) !== false) {
    //                 $rows[] = $data;
    //             }
    //             fclose($handle);
    //         }
    //     }

    //     $rows = array_filter($rows);
    //     if (count($rows) < 2) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'No data found in file.'
    //         ], 400);
    //     }

    //     $firstRow = array_values($rows)[0];
    //     $header = array_map(function ($h) {
    //         return strtolower(str_replace([' ', "\xEF\xBB\xBF"], ['_', ''], trim($h)));
    //     }, $firstRow);
    //     unset($rows[array_key_first($rows)]);

    //     $insertData = [];
    //     foreach ($rows as $r) {
    //         $r = array_values($r);
    //         $data = array_combine($header, $r);

    //         if (!empty($data['focus_keyword'])) {
    //             $insertData[] = [
    //                 'focus_keyword' => $data['focus_keyword'] ?? null,
    //                 'content' => $data['content'] ?? null,
    //                 'image' => $data['image'] ?? null,
    //                 'image_alt' => $data['image_alt'] ?? null,
    //                 'h1_heading' => $data['h1_heading'] ?? null,
    //                 'faqs' => $data['faqs'] ?? null,
    //                 'section_content_left' => $data['section_content_left'] ?? null,
    //                 'section_content_right' => $data['section_content_right'] ?? null,
    //                 'image_left' => $data['image_left'] ?? null,
    //                 'image_right' => $data['image_right'] ?? null,
    //                 'image_left_alt' => $data['image_left_alt'] ?? null,
    //                 'image_right_alt' => $data['image_right_alt'] ?? null,
    //             ];
    //         }
    //     }

    //     if (!empty($insertData)) {
    //         ProgramaticSeo::insert($insertData);
    //     }

    //     return response()->json([
    //         'success' => true,
    //         'message' => count($insertData) . ' records imported successfully.',
    //         'data' => $insertData
    //     ]);
    // }

    public function import(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'csv_file' => 'required|file|mimes:csv,xls,xlsx,txt|max:5120',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $path = $request->file('csv_file')->getRealPath();
        $extension = $request->file('csv_file')->getClientOriginalExtension();
        
        $rows = [];
        if (in_array($extension, ['xls', 'xlsx'])) {
            $spreadsheet = IOFactory::load($path);
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray(null, true, true, true);
        } else {
            if (($handle = fopen($path, 'r')) !== false) {
                while (($data = fgetcsv($handle, 10000, ',')) !== false) {
                    $rows[] = $data;
                }
                fclose($handle);
            }
        }

        $rows = array_filter($rows);
        if (count($rows) < 2) {
            return response()->json(['success' => false, 'message' => 'No data found in file.'], 400);
        }

        $firstRow = array_values($rows)[0];
        $header = array_map(function ($h) {
            return strtolower(str_replace([' ', "\xEF\xBB\xBF"], ['_', ''], trim($h)));
        }, $firstRow);
        unset($rows[array_key_first($rows)]);

        $newCount = 0;
        $updatedCount = 0;
        $skippedCount = 0;

        foreach ($rows as $r) {
            $r = array_values($r);
            // Header count mismatch fix
            if (count($header) !== count($r)) continue;
            
            $data = array_combine($header, $r);

            if (!empty($data['focus_keyword'])) {
                // Duplicate Check Logic
                $existing = ProgramaticSeo::where('focus_keyword', $data['focus_keyword'])->first();

                $mappedData = [
                    'focus_keyword' => $data['focus_keyword'] ?? null,
                    'content' => $data['content'] ?? null,
                    'image' => $data['image'] ?? null,
                    'image_alt' => $data['image_alt'] ?? null,
                    'h1_heading' => $data['h1_heading'] ?? null,
                    'faqs' => $data['faqs'] ?? null,
                    'section_content_left' => $data['section_content_left'] ?? null,
                    'section_content_right' => $data['section_content_right'] ?? null,
                    'image_left' => $data['image_left'] ?? null,
                    'image_right' => $data['image_right'] ?? null,
                    'image_left_alt' => $data['image_left_alt'] ?? null,
                    'image_right_alt' => $data['image_right_alt'] ?? null,
                ];

                if ($existing) {
                    // Check if content is actually different
                    $isDifferent = false;
                    foreach ($mappedData as $key => $value) {
                        if ($existing->$key != $value) {
                            $isDifferent = true;
                            break;
                        }
                    }

                    if ($isDifferent) {
                        $existing->update($mappedData);
                        $updatedCount++;
                    } else {
                        $skippedCount++;
                    }
                } else {
                    ProgramaticSeo::create($mappedData);
                    $newCount++;
                }
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Import process completed.',
            'summary' => [
                'new' => $newCount,
                'updated' => $updatedCount,
                'skipped' => $skippedCount
            ]
        ]);
    }
}
