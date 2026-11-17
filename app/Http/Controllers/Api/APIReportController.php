<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class APIReportController extends Controller
{
    /**
     * Store a newly created report in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Create a new report using the validated data
        $report = Report::create([
            'clinic_id' => 2,
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        // Return a success response
        return response()->json([
            'message' => 'Report created successfully',
            'report' => $report
        ], Response::HTTP_CREATED);
    }
}
