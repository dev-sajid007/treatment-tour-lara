<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Clinic;
use Illuminate\Http\Request;

class APIReviewController extends Controller
{


    public function index($clinicId)
    {
        // Manually fetch the clinic by its ID
        $clinic = Clinic::findOrFail($clinicId);

        // Get all doctors associated with the clinic
        $reviews = $clinic->reviews()->get();

        // Return the data as JSON
        return response()->json($reviews);
    }
    public function store(Request $request, Clinic $clinic)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'review' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $review = $clinic->reviews()->create([
            'name' => $request->name,
            'date' => $request->date,
            'review' => $request->review,
            'rating' => $request->rating,
        ]);

        return response()->json($review, 201);
    }

    public function show(Clinic $clinic, Review $review)
    {
        // Check if the review belongs to the clinic
        if ($review->clinic_id !== $clinic->id) {
            return response()->json(['error' => 'Review not found for this clinic'], 404);
        }

        return response()->json($review);
    }

    public function update(Request $request, Clinic $clinic, Review $review)
    {
        // Check if the review belongs to the clinic
        if ($review->clinic_id !== $clinic->id) {
            return response()->json(['error' => 'Review not found for this clinic'], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'review' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $review->update($request->all());

        return response()->json($review);
    }

    public function destroy(Clinic $clinic, Review $review)
    {
        // Check if the review belongs to the clinic
        if ($review->clinic_id !== $clinic->id) {
            return response()->json(['error' => 'Review not found for this clinic'], 404);
        }

        $review->delete();

        return response()->json(null, 204);
    }
}
