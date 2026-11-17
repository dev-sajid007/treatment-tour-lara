<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory; // Import Subcategory model
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    /**
     * Display a listing of the resource along with subcategories.
     */
    public function index()
    {
        // Fetch all categories
        $categories = Category::all();
        
        // Initialize an array to hold the final response
        $data = [];

        // Loop through each category
        foreach ($categories as $category) {
            // Fetch subcategories for each category
            $subcategories = SubCategory::where('category_id', $category->id)->get(['id', 'name', 'details']);
            
            // Add category data along with subcategories to the response
            $data[] = [
                'id' => $category->id,
                'name' => $category->name,
                'details' => $category->details,
                'image' => $category->image,
                'created_at' => $category->created_at,
                'updated_at' => $category->updated_at,
                'subcategories' => $subcategories
            ];
        }

        // Return the manually built response as JSON
        return response()->json($data);
    }

    /**
     * Display the specified resource along with subcategories.
     */
    public function show(string $id)
    {
        // Fetch a single category by its ID
        $category = Category::find($id);

        // Check if category exists
        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        // Fetch subcategories for the category
        $subcategories = SubCategory::where('category_id', $category->id)->get(['id', 'name', 'details']);

        // Build the response manually
        $data = [
            'id' => $category->id,
            'name' => $category->name,
            'details' => $category->details,
            'image' => $category->image,
            'created_at' => $category->created_at,
            'updated_at' => $category->updated_at,
            'subcategories' => $subcategories
        ];

        // Return the response as JSON
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Fetch the category
        $category = Category::find($id);

        // Check if category exists
        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        // Delete the category
        $category->delete();

        return response()->json(['message' => 'Category deleted successfully']);
    }
}
