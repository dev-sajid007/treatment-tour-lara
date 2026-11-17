<?php

namespace App\Http\Controllers\ClinicController;
use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\Clinic;
use Illuminate\Http\Request;

class ClinicPortfolioController extends Controller
{
 // Display the portfolio page for adding and viewing portfolios for a clinic
public function index()
{
    // Get clinic_id from session
    $clinic_id = session('clinic_id');

    // Find the clinic and get its portfolios
    $clinic = Clinic::findOrFail($clinic_id);
    $portfolios = Portfolio::where('clinic_id', $clinic_id)->get();

    return view('clinic.portfolios.index', compact('clinic', 'portfolios'));
}


   // Store a new portfolio
public function store(Request $request)
{
    // Get clinic_id from session
    $clinic_id = session('clinic_id');

    $request->validate([
        'title' => 'required',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    // Handle image upload
    $imageName = time() . '.' . $request->image->getClientOriginalExtension();
    $request->image->move(public_path('storage/portfolio'), $imageName);

    // Create the portfolio
    Portfolio::create([
        'clinic_id' => $clinic_id,
        'title' => $request->title,
        'image' => $imageName
    ]);

    return redirect()->route('clinics.portfolios.index')->with('success', 'Portfolio added successfully.');
}



    public function destroy($id)
    {
        $portfolio = Portfolio::findOrFail($id);

        // Delete the portfolio image from storage
        if (file_exists(public_path('storage/portfolio/' . $portfolio->image))) {
            unlink(public_path('storage/portfolio/' . $portfolio->image));
        }

        // Delete the portfolio from the database
        $portfolio->delete();

        return redirect()->back()->with('success', 'Portfolio deleted successfully.');
    }

}
