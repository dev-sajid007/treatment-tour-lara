<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FreeQuote;
use App\Models\Country;
use App\Models\SubCategory;


class FreeQuoteController extends Controller
{
    public function index()
    {
        $quotes = FreeQuote::latest()->get();
        return view('free_quotes.index', compact('quotes'));
    }


    public function create()
    {
        $countries = Country::latest()->get();
        $treatments = SubCategory::latest()->get();
        return view('free_quotes.create', compact('countries', 'treatments'));
    }


    public function store(Request $request)
    {
       


        FreeQuote::create($request->all());

        return redirect()->route('web.home')->with('success', 'Quote submitted successfully.');
    }


    public function show(FreeQuote $freeQuote)
    {
        return view('free_quotes.show', compact('freeQuote'));
    }


    public function edit(FreeQuote $freeQuote)
    {
        return view('free_quotes.edit', compact('freeQuote'));
    }


    public function update(Request $request, FreeQuote $freeQuote)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'phone' => 'required|string|max:20',
            'destination' => 'required|string|max:191',
            'treatment' => 'required|string|max:191',
            'agreed_to_terms' => 'required|boolean',
        ]);

        $freeQuote->update($validated);

        return redirect()->route('free-quotes.index')->with('success', 'Quote updated successfully.');
    }


    public function destroy(FreeQuote $freeQuote)
    {
        $freeQuote->delete();

        return redirect()->route('free-quotes.index')->with('success', 'Quote deleted successfully.');
    }
}
