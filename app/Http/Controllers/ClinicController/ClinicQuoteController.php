<?php

namespace App\Http\Controllers\ClinicController;
use App\Http\Controllers\Controller;

use App\Models\Quote;
use App\Models\Clinic;
use Illuminate\Http\Request;

class ClinicQuoteController extends Controller
{
    // Show quotes page
    public function index()
    {
        // Retrieve clinic_id from session
        $clinic_id = session('clinic_id');
        
        // Find clinic and get quotes
        $clinic = Clinic::findOrFail($clinic_id);
        $quotes = Quote::where('clinic_id', $clinic_id)->get();

        return view('clinic.quotes.index', compact('clinic', 'quotes'));
    }


    // Store a new quote
public function store(Request $request)
{
    // Retrieve clinic_id from session
    $clinic_id = session('clinic_id');

    $request->validate([
        'name' => 'required',
        'procedure' => 'required',
        'price' => 'required|numeric',
        'duration' => 'required',
    ]);

    // Create the quote
    Quote::create([
        'clinic_id' => $clinic_id,
        'name' => $request->name,
        'procedure' => $request->procedure,
        'price' => $request->price,
        'duration' => $request->duration,
    ]);

    return redirect()->route('clinics.quote.index')->with('success', 'Quote added successfully.');
}


   // Update quote
public function update(Request $request, $quote_id)
{
    // Find the quote
    $quote = Quote::findOrFail($quote_id);

    $request->validate([
        'name' => 'required',
        'procedure' => 'required',
        'price' => 'required|numeric',
        'duration' => 'required',
    ]);

    // Update the quote
    $quote->update([
        'name' => $request->name,
        'procedure' => $request->procedure,
        'price' => $request->price,
        'duration' => $request->duration,
    ]);

    return redirect()->route('clinics.quote.index')->with('success', 'Quote updated successfully.');
}


    // Delete quote
    public function destroy($quote_id)
    {
        $quote = Quote::findOrFail($quote_id);
        $quote->delete();

        return redirect()->back()->with('success', 'Quote deleted successfully.');
    }
}
