<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\State; // Import the State model
use Illuminate\Http\Request;
use App\Models\Clinic;
class StateApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all states and return them
        $states = State::all();
        return response()->json($states);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Fetch a single state by its ID
        $state = State::find($id);

        // Check if state exists
        if (!$state) {
            return response()->json(['error' => 'State not found'], 404);
        }

        // Return the found state
        return response()->json($state);
    }

    /**
     * Remove the specified resource from storage (optional if deletion is needed).
     */
    public function destroy(string $id)
    {
        $state = State::find($id);

        // Check if state exists
        if (!$state) {
            return response()->json(['error' => 'State not found'], 404);
        }

        // Delete the state
        $state->delete();

        return response()->json(['message' => 'State deleted successfully']);
    }

    public function getClinics($stateId)
    {
        // Fetch clinics associated with the given state ID, including relationships
        $clinics = Clinic::with(['state', 'country'])
            ->where('state_id', $stateId)
            ->get();

        // Transform the clinics collection to include the average rating and names
        $clinicsResponse = $clinics->map(function ($clinic) {
            // Calculate average rating for the clinic
            $averageRating = $clinic->reviews()->avg('rating'); // Assuming you have a reviews relationship
            
            return [
                'id' => $clinic->id,
                'name' => $clinic->name,
                'description' => $clinic->description,
                'address' => $clinic->address,
                'main_image' => $clinic->main_image,
                'gallery_images' => json_decode($clinic->gallery_images),
                'map_embed_code' => $clinic->map_embed_code,
                'country_id' => $clinic->country_id,
                'country_name' => $clinic->country->name ?? 'Unknown Country',
                'state_id' => $clinic->state_id,
                'state_name' => $clinic->state->name ?? 'Unknown State',
                'average_rating' => round($averageRating, 2) ?? 0, // Round to 2 decimal places
                'created_at' => $clinic->created_at,
                'updated_at' => $clinic->updated_at,
            ];
        });

        return response()->json($clinicsResponse);
    }
}
