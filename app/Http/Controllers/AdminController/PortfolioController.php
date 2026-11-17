<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use App\Models\Clinic;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    // Display the portfolio page for adding and viewing portfolios for a clinic
    public function index($clinic_id)
    {
        $clinic = Clinic::findOrFail($clinic_id);
        $portfolios = Portfolio::where('clinic_id', $clinic_id)->get();

        return view('admin.portfolios.index', compact('clinic', 'portfolios'));
    }

    // Store a new portfolio
    public function store(Request $request, $clinic_id)
    {
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

        return redirect()->route('admin.portfolios.index', $clinic_id)->with('success', 'Portfolio added successfully.');
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
