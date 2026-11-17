<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Speciality;

class SpecialityController extends Controller
{
    public function index()
    {
        $specialities = Speciality::all(); 
        return view('admin.specialities.index', compact('specialities'));
    }


    public function store(Request $request)
    {
        // Validate the input fields
        $request->validate([
            'name' => 'required|string|max:60',
            'logo' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:5048', // Ensure it's an image and no larger than 2MB
        ]);

        // Handle file upload to public folder
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoName = time() . '_' . $logo->getClientOriginalName(); // Generate a unique name for the file
            $logo->move(public_path('images/specialities'), $logoName); // Move the file to the public/images/specialities folder
        }

        // Create the new speciality
        Speciality::create([
            'name' => $request->name,
            'logo' => 'images/specialities/' . $logoName, // Save the path relative to the public folder
        ]);

        // Redirect with a success message
        return redirect()->route('specialities.index')->with('success', 'Speciality added successfully.');
    }



    public function update(Request $request, $id)
    {
        // Validate the input fields
        $request->validate([
            'name' => 'required|string|max:60',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:5048', // The logo is optional for update
        ]);

        // Find the speciality to update
        $speciality = Speciality::findOrFail($id);

        // Handle file upload if a new logo is provided
        if ($request->hasFile('logo')) {
            // Delete the old logo file if it exists
            if (file_exists(public_path($speciality->logo))) {
                unlink(public_path($speciality->logo)); // Delete the old file
            }

            // Upload the new logo
            $logo = $request->file('logo');
            $logoName = time() . '_' . $logo->getClientOriginalName(); // Generate a unique name for the file
            $logo->move(public_path('images/specialities'), $logoName); // Store the new file in the public/images/specialities folder

            // Update the logo path
            $speciality->logo = 'images/specialities/' . $logoName;
        }

        // Update the name of the speciality
        $speciality->name = $request->name;

        // Save the updated speciality
        $speciality->save();

        // Redirect with a success message
        return redirect()->route('specialities.index')->with('success', 'Speciality updated successfully.');
    }





    public function destroy($id)
    {
        // Find the speciality to delete
        $speciality = Speciality::findOrFail($id);

        // Delete the logo file if it exists
        if (file_exists(public_path($speciality->logo))) {
            unlink(public_path($speciality->logo)); // Delete the file
        }

        // Delete the speciality record from the database
        $speciality->delete();
        return redirect()->route('specialities.index')->with('success', 'Speciality deleted successfully.');
    }




}
