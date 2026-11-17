<?php

namespace App\Http\Controllers\ClinicController;

use App\Http\Controllers\Controller;
use App\Models\Clinic;
use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    // Display a listing of the reports
    public function index()
    {
        // Get the clinic_id from session
        $clinic_id = session('clinic_id');

        // Find the clinic using the clinic_id from session
        $clinic = Clinic::findOrFail($clinic_id);

        // Get reports for the clinic
        $reports = Report::where('clinic_id', $clinic_id)->get();

        return view('clinic.reports.index', compact('clinic', 'reports'));
    }

    // Show the form for creating a new report
    public function create()
    {
        // Get the clinic_id from session
        $clinic_id = session('clinic_id');

        // Find the clinic using the clinic_id from session
        $clinic = Clinic::findOrFail($clinic_id);

        return view('clinic.reports.create', compact('clinic'));
    }
// Store a newly created report
public function store(Request $request)
{
    // Get the clinic_id from session
    $clinic_id = session('clinic_id');

    // Validate the request
    $request->validate([
        'title' => 'required',
        'file' => 'nullable',
    ]);

    // Handle file upload with manual file move
    $filePath = null;
    if ($request->hasFile('file')) {
        // Create a unique file name
        $fileName = time() . '.' . $request->file->getClientOriginalExtension();

        // Move the file to the specified directory
        $request->file->move(public_path('storage/reports'), $fileName);

        // Set the file path for storing in the database
        $filePath = 'reports/' . $fileName;
    }

    // Create the report
    Report::create([
        'clinic_id' => $clinic_id,
        'title' => $request->title,
        'description' => $request->description,
        'file_path' => $filePath,
    ]);

    return redirect()->route('clinics.reports.index')->with('success', 'Report added successfully.');
}


    // Remove the specified report
    public function destroy($report_id)
    {
        // Get the clinic_id from session
        $clinic_id = session('clinic_id');

        // Find the report by clinic_id and report_id
        $report = Report::where('clinic_id', $clinic_id)->findOrFail($report_id);

        // Delete the report
        $report->delete();

        return redirect()->route('clinics.reports.index')->with('success', 'Report deleted successfully.');
    }
}
