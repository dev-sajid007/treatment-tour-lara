<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SubCategory; // Import the SubCategory model
use Illuminate\Http\Request;

class SubCategoryApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all subcategories and return them
        $subCategories = SubCategory::all();
        return response()->json($subCategories);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Fetch a single subcategory by its ID
        $subCategory = SubCategory::find($id);

        // Check if subcategory exists
        if (!$subCategory) {
            return response()->json(['error' => 'SubCategory not found'], 404);
        }

        // Return the found subcategory
        return response()->json($subCategory);
    }

    /**
     * Remove the specified resource from storage (optional if deletion is needed).
     */
    public function destroy(string $id)
    {
        $subCategory = SubCategory::find($id);

        // Check if subcategory exists
        if (!$subCategory) {
            return response()->json(['error' => 'SubCategory not found'], 404);
        }

        // Delete the subcategory
        $subCategory->delete();

        return response()->json(['message' => 'SubCategory deleted successfully']);
    }
}
