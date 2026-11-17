<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    // Display countries
    public function index()
    {
        $countries = Country::all(); // Fetch all countries
        return view('admin.location.index', compact('countries'));
    }

    // Store a new Country
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'details' => 'nullable'
        ]);

        $country = new Country();
        $country->name = $request->name;
        $country->details = $request->details;
        $country->save();

        return redirect()->route('admin.location.index')->with('success', 'Country added successfully.');
    }

    // Update an existing Country
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'details' => 'nullable'
        ]);

        $country = Country::findOrFail($id);
        $country->name = $request->name;
        $country->details = $request->details;
        $country->save();

        return redirect()->route('admin.location.index')->with('success', 'Country updated successfully.');
    }

    // Delete a Country
    public function destroy($id)
    {
        $country = Country::findOrFail($id);
        $country->delete();

        return redirect()->route('admin.location.index')->with('success', 'Country deleted successfully.');
    }


     // Display all States (indexstate method)
     public function indexstate()
     {
         $states = State::with('country')->get(); // Fetch all states with their respective countries
         $countries = Country::all(); // Fetch all countries for selection in the form
         return view('admin.location.state_index', compact('states', 'countries'));
     }
 
     // Store a new State (storestate method)
     public function storestate(Request $request)
     {
         $request->validate([
             'country_id' => 'required|exists:countries,id',
             'name' => 'required',
             'details' => 'nullable'
         ]);
 
         $state = new State();
         $state->country_id = $request->country_id;
         $state->name = $request->name;
         $state->details = $request->details;
         $state->save();
 
         return redirect()->route('admin.location.indexstate')->with('success', 'State added successfully.');
     }
 
     // Update an existing State (updatestate method)
     public function updatestate(Request $request, $id)
     {
         $request->validate([
             'country_id' => 'required|exists:countries,id',
             'name' => 'required',
             'details' => 'nullable'
         ]);
 
         $state = State::findOrFail($id);
         $state->country_id = $request->country_id;
         $state->name = $request->name;
         $state->details = $request->details;
         $state->save();
 
         return redirect()->route('admin.location.indexstate')->with('success', 'State updated successfully.');
     }
 
     // Delete a State (deletestate method)
     public function deletestate($id)
     {
         $state = State::findOrFail($id);
         $state->delete();
 
         return redirect()->route('admin.location.indexstate')->with('success', 'State deleted successfully.');
     }
}
