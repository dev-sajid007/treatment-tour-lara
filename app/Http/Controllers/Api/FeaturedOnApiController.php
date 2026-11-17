<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FeaturedOn; // Import the FeaturedOn model
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class FeaturedOnApiController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        // Fetch all FeaturedOn entries
        $featured = FeaturedOn::all();

        // Return the fetched data in JSON format
        return response()->json([
            'success' => true,
            'data' => $featured
        ], 200);
    }

    /**
     * Display the specified resource.
     * 
     * @param string $id
     * @return JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        // Find the FeaturedOn entry by its ID
        $featured = FeaturedOn::find($id);

        // If entry is not found, return 404
        if (!$featured) {
            return response()->json([
                'success' => false,
                'message' => 'FeaturedOn entry not found'
            ], 404);
        }

        // Return the found FeaturedOn entry in JSON format
        return response()->json([
            'success' => true,
            'data' => $featured
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @param string $id
     * @return JsonResponse
     */
    public function destroy(string $id): JsonResponse
    {
        // Find the FeaturedOn entry by its ID
        $featured = FeaturedOn::find($id);

        // If entry is not found, return 404
        if (!$featured) {
            return response()->json([
                'success' => false,
                'message' => 'FeaturedOn entry not found'
            ], 404);
        }

        // Delete the entry
        $featured->delete();

        // Return success message after deletion
        return response()->json([
            'success' => true,
            'message' => 'FeaturedOn entry deleted successfully'
        ], 200);
    }
}
