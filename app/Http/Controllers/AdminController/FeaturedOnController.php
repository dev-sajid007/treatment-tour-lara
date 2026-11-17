<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Models\FeaturedOn;
use Illuminate\Http\Request;

class FeaturedOnController extends Controller
{
    // Display the list of featured platforms
    public function index()
    {
        $featuredOns = FeaturedOn::all(); // Get all featured platforms
        return view('admin.featured_on.index', compact('featuredOns'));
    }

    // Store a new Featured Platform
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $featuredOn = new FeaturedOn();
        $featuredOn->name = $request->name;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/img'), $imageName);
            $featuredOn->image = $imageName;
        }

        $featuredOn->save();

        return redirect()->route('admin.featured_on.index')->with('success', 'Featured platform added successfully.');
    }

    // Update an existing Featured Platform
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $featuredOn = FeaturedOn::findOrFail($id);
        $featuredOn->name = $request->name;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/img'), $imageName);
            $featuredOn->image = $imageName;
        }

        $featuredOn->save();

        return redirect()->route('admin.featured_on.index')->with('success', 'Featured platform updated successfully.');
    }

    // Delete a Featured Platform
    public function destroy($id)
    {
        $featuredOn = FeaturedOn::findOrFail($id);
        if ($featuredOn->image) {
            unlink(public_path('storage/img/' . $featuredOn->image));
        }
        $featuredOn->delete();

        return redirect()->route('admin.featured_on.index')->with('success', 'Featured platform deleted successfully.');
    }
}
