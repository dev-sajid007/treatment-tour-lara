<?php

namespace App\Http\Controllers\ClinicController;
use App\Http\Controllers\Controller;

use App\Models\Review;
use App\Models\Clinic;
use Illuminate\Http\Request;

class ClinicReviewController extends Controller
{
    // Display the reviews page for adding and viewing reviews for a clinic
    public function index()
    {
        $clinic_id = session('clinic_id');
        $clinic = Clinic::findOrFail($clinic_id);
        $reviews = Review::where('clinic_id', $clinic_id)->get();

        return view('clinic.reviews.index', compact('clinic', 'reviews'));
    }

    // Store a new review
    public function store(Request $request)
    {
        $clinic_id = session('clinic_id');

        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'review' => 'required|string',
            'rating' => 'required|string|min:1|max:5',
        ]);

        Review::create([
            'clinic_id' => $clinic_id,
            'name' => $request->name,
            'date' => $request->date,
            'review' => $request->review,
            'rating' => $request->rating,
        ]);

        return redirect()->route('clinics.reviews.index')->with('success', 'Review added successfully.');
    }

    // Delete the review
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->back()->with('success', 'Review deleted successfully.');
    }
}
