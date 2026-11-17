<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quote; // Import the Quote model
use Illuminate\Http\Request;

class APIQuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all quotes and return them
        $quotes = Quote::all();
        return response()->json($quotes);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Fetch a single quote by its ID
        $quote = Quote::find($id);

        // Check if quote exists
        if (!$quote) {
            return response()->json(['error' => 'Quote not found'], 404);
        }

        // Return the found quote
        return response()->json($quote);
    }

    /**
     * Remove the specified resource from storage (Optional if you want to allow deletion).
     */
    public function destroy(string $id)
    {
        $quote = Quote::find($id);

        // Check if quote exists
        if (!$quote) {
            return response()->json(['error' => 'Quote not found'], 404);
        }

        // Delete the quote
        $quote->delete();

        return response()->json(['message' => 'Quote deleted successfully']);
    }
}
