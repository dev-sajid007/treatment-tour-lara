<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use App\Models\Clinic;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    // Show quotes page
    public function index($clinic_id)
    {
        $clinic = Clinic::findOrFail($clinic_id);
        $quotes = Quote::where('clinic_id', $clinic_id)->get();

        return view('admin.quotes.index', compact('clinic', 'quotes'));
    }

    // Store a new quote
    public function store(Request $request, $clinic_id)
    {
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

        return redirect()->route('admin.quote.index', $clinic_id)->with('success', 'Quote added successfully.');
    }

    // Update quote
    public function update(Request $request, $quote_id)
    {
        $quote = Quote::findOrFail($quote_id);

        $request->validate([
            'name' => 'required',
            'procedure' => 'required',
            'price' => 'required|numeric',
            'duration' => 'required',
        ]);

        $quote->update([
            'name' => $request->name,
            'procedure' => $request->procedure,
            'price' => $request->price,
            'duration' => $request->duration,
        ]);

        return redirect()->route('admin.quote.index', $quote->clinic_id)->with('success', 'Quote updated successfully.');
    }

    // Delete quote
    public function destroy($quote_id)
    {
        $quote = Quote::findOrFail($quote_id);
        $quote->delete();

        return redirect()->back()->with('success', 'Quote deleted successfully.');
    }
}
