<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use App\Models\Clinic;
use Illuminate\Http\Request;

class APIPortfolioController extends Controller
{

public function index($clinicId)
{
    // Manually fetch the clinic by its ID
    $clinic = Clinic::findOrFail($clinicId);

    // Get all doctors associated with the clinic
    $quotes = $clinic->portfolios()->get();

    // Return the data as JSON
    return response()->json($quotes);
}


    public function store(Request $request, Clinic $clinic)
    {
        $request->validate([
            'name' => 'required',
            'procedure' => 'required',
            'price' => 'required|numeric',
            'duration' => 'required',
        ]);

        return $clinic->quotes()->create($request->all());
    }

    public function show(Clinic $clinic, Quote $quote)
    {
        return $quote;
    }

    public function update(Request $request, Clinic $clinic, Quote $quote)
    {
        $request->validate([
            'name' => 'required',
            'procedure' => 'required',
            'price' => 'required|numeric',
            'duration' => 'required',
        ]);

        $quote->update($request->all());

        return $quote;
    }

    public function destroy(Clinic $clinic, Quote $quote)
    {
        $quote->delete();

        return response(null, 204);
    }
}
