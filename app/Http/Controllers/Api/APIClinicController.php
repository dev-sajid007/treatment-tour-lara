<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Clinic;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;

class APIClinicController extends Controller
{
    public function index()
    {
        // Fetch all clinics
        $clinics = Clinic::all();

        // Initialize an array to hold the final response
        $data = [];

        foreach ($clinics as $clinic) {
            // Fetch the country and state names
            $country = Country::find($clinic->country_id);
            $state = State::find($clinic->state_id);

            // Calculate the average rating
            $averageRating = $clinic->reviews()->avg('rating') ?: 0; // Default to 0 if no reviews

            // Add clinic data along with country, state, and average rating to the response
            $data[] = [
                'id' => $clinic->id,
                'name' => $clinic->name,
                'description' => $clinic->description,
                'address' => $clinic->address,
                'main_image' => $clinic->main_image,
                'gallery_images' => $clinic->gallery_images,
                'map_embed_code' => $clinic->map_embed_code,
                'country_id' => $clinic->country_id,
                'state_id' => $clinic->state_id,
                'created_at' => $clinic->created_at,
                'country' => $country ? $country->name : 'Unknown Country',
                'state' => $state ? $state->name : 'Unknown State',
                'average_rating' => round($averageRating, 2), // Round to 2 decimal places
            ];
        }

        // Return the response as JSON
        return response()->json($data);
    }



    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'country_id' => 'required',
            'state_id' => 'required',
        ]);

        return Clinic::create($request->all());
    }

    public function show($id)
    {
        // Find the clinic by ID
        $clinic = Clinic::find($id);

        // Check if the clinic exists
        if (!$clinic) {
            return response()->json(['message' => 'Clinic not found'], 404);
        }

        // Prepare the response data
        $responseData = [
            'id' => $clinic->id,
            'name' => $clinic->name,
            'description' => $clinic->description,
            'address' => $clinic->address,
            'main_image' => $clinic->main_image,
            'gallery_images' => json_decode($clinic->gallery_images), // Decoding JSON string to array
            'map_embed_code' => $clinic->map_embed_code,
            'country_id' => $clinic->country_id,
            'state_id' => $clinic->state_id,
            'created_at' => $clinic->created_at,
            'country' => $clinic->country,
            'state' => $clinic->state,
            'average_rating' => $clinic->average_rating,
        ];

        return response()->json($responseData); // This will return Illuminate\Http\JsonResponse
    }

    public function update(Request $request, Clinic $clinic)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'country_id' => 'required',
            'state_id' => 'required',
        ]);

        $clinic->update($request->all());

        return $clinic;
    }

    public function destroy(Clinic $clinic)
    {
        $clinic->delete();

        return response(null, 204);
    }

    public function getClinicsByCategory($categoryId)
    {
        // Fetch clinics with associated country, state, and average rating
        $clinics = Clinic::whereHas('categories', function ($query) use ($categoryId) {
            $query->where('category_id', $categoryId);
        })->get()->map(function ($clinic) {
            $country = $clinic->country; // Assuming relationship exists
            $state = $clinic->state; // Assuming relationship exists
            $averageRating = $clinic->reviews->avg('rating') ?? 0;
    
            return [
                'id' => $clinic->id,
                'name' => $clinic->name,
                'description' => $clinic->description,
                'address' => $clinic->address,
                'main_image' => $clinic->main_image,
                'gallery_images' => json_decode($clinic->gallery_images), // Decoding JSON string to array
                'map_embed_code' => $clinic->map_embed_code,
                'country_id' => $clinic->country_id,
                'state_id' => $clinic->state_id,
                'created_at' => $clinic->created_at,
                'country' => $country ? $country->name : 'Unknown Country',
                'state' => $state ? $state->name : 'Unknown State',
                'average_rating' => round($averageRating, 2),
            ];
        });
    
        return response()->json($clinics);
    }
    
    public function getClinicsBySubCategory($subcategoryId)
    {
        // Fetch clinics with associated country, state, and average rating
        $clinics = Clinic::whereHas('subcategories', function ($query) use ($subcategoryId) {
            $query->where('subcategory_id', $subcategoryId);
        })->get()->map(function ($clinic) {
            $country = $clinic->country;
            $state = $clinic->state;
            $averageRating = $clinic->reviews->avg('rating') ?? 0;
    
            return [
                'id' => $clinic->id,
                'name' => $clinic->name,
                'description' => $clinic->description,
                'address' => $clinic->address,
                'main_image' => $clinic->main_image,
                'gallery_images' => json_decode($clinic->gallery_images), // Decoding JSON string to array
                'map_embed_code' => $clinic->map_embed_code,
                'country_id' => $clinic->country_id,
                'state_id' => $clinic->state_id,
                'created_at' => $clinic->created_at,
                'country' => $country ? $country->name : 'Unknown Country',
                'state' => $state ? $state->name : 'Unknown State',
                'average_rating' => round($averageRating, 2),
            ];
        });
    
        return response()->json($clinics);
    }


      // Method to search clinics by name, description, or address
      public function search(Request $request)
    {
        // Get the search query parameter
        $query = $request->query('q');

        // Start the query to fetch clinics
        $clinics = Clinic::query();

        // If the query parameter is provided, apply a filter across multiple fields
        if ($query) {
            $clinics->where(function ($q) use ($query) {
                $q->where('name', 'like', '%' . $query . '%')
                  ->orWhere('description', 'like', '%' . $query . '%')
                  ->orWhere('address', 'like', '%' . $query . '%');
            });
        }

        // Execute the query and get the clinics
        $clinics = $clinics->get();

        // Prepare the response with clinic data, including country, state, and average rating
        $data = $clinics->map(function ($clinic) {
            $country = $clinic->country; // Assuming relationship exists
            $state = $clinic->state; // Assuming relationship exists
            $averageRating = $clinic->reviews()->avg('rating') ?: 0; // Default to 0 if no reviews

            return [
                'id' => $clinic->id,
                'name' => $clinic->name,
                'description' => $clinic->description,
                'address' => $clinic->address,
                'main_image' => $clinic->main_image,
                'gallery_images' => json_decode($clinic->gallery_images), // Decoding JSON string to array
                'map_embed_code' => $clinic->map_embed_code,
                'country_id' => $clinic->country_id,
                'state_id' => $clinic->state_id,
                'created_at' => $clinic->created_at,
                'country' => $country ? $country->name : 'Unknown Country',
                'state' => $state ? $state->name : 'Unknown State',
                'average_rating' => round($averageRating, 2), // Round to 2 decimal places
            ];
        });

        // Return the response as JSON
        return response()->json($data);
    }
    
}
