<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Models\Clinic;
use App\Models\Report;
use App\Models\Contact;

use Illuminate\Http\Request;

class AdminReportController extends Controller
{
    // Display a listing of all reports across all clinics
    public function index()
    {
        // Get all reports with their respective clinics
        $reports = Report::with('clinic')->get();

        return view('admin.reports.index', compact('reports'));
    }

    // Remove the specified report
    public function destroy($report_id)
    {
        // Find the report by its ID
        $report = Report::findOrFail($report_id);

        // Delete the report
        $report->delete();

        return redirect()->route('admin.reports.index')->with('success', 'Report deleted successfully.');
    }



// Contact
public function contacts()
{
    // Get all contacts, ordered by the latest created
    $contacts = Contact::latest()->get();

    return view('admin.contacts.index', compact('contacts'));
}


    // Remove the specified report
    public function contactsdestroy($report_id)
    {
        // Find the report by its ID
        $report = Contact::findOrFail($report_id);

        // Delete the report
        $report->delete();

        return redirect()->route('admin.contacts.index')->with('success', 'Contact deleted successfully.');
    }
}
