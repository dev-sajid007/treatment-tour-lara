<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\State; // Import the State model
use Illuminate\Http\Request;
use App\Models\Clinic;
class CountryApiController extends Controller
{
    /**
     * Display a listing of the countries along with their states.
     */
    public function index()
    {
        // Fetch all countries
        $countries = Country::all();
        
        // Initialize an array to hold the final response
        $data = [];

        // Loop through each country
        foreach ($countries as $country) {
            // Fetch states for each country
            $states = State::where('country_id', $country->id)->get(['id', 'country_id', 'name','details']);

            // Add country data along with states to the response
            $data[] = [
                'id' => $country->id,
                'name' => $country->name,
                'code' => $country->code, // Assuming there's a country code field
                'created_at' => $country->created_at,
                'updated_at' => $country->updated_at,
                'subcategories' => $states
            ];
        }

        // Return the manually built response as JSON
        return response()->json($data);
    }

    /**
     * Display the specified country along with its states.
     */
    public function show(string $id)
    {
        // Fetch a single country by its ID
        $country = Country::find($id);

        // Check if country exists
        if (!$country) {
            return response()->json(['error' => 'Country not found'], 404);
        }

        // Fetch states for the country
        $states = State::where('country_id', $country->id)->get(['id', 'name','details']);

        // Build the response manually
        $data = [
            'id' => $country->id,
            'name' => $country->name,
            'details' => $country->details, // Assuming there's a country code field
            'created_at' => $country->created_at,
            'updated_at' => $country->updated_at,
            'states' => $states
        ];

        // Return the response as JSON
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage (optional if deletion is needed).
     */
    public function destroy(string $id)
    {
        // Fetch the country
        $country = Country::find($id);

        // Check if country exists
        if (!$country) {
            return response()->json(['error' => 'Country not found'], 404);
        }

        // Delete the country
        $country->delete();

        return response()->json(['message' => 'Country deleted successfully']);
    }


    public function getClinics($countryId)
    {
        // Fetch clinics associated with the given country ID, including relationships
        $clinics = Clinic::with(['state', 'country'])
            ->where('country_id', $countryId)
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
