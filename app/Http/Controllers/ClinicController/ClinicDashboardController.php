<?php

namespace App\Http\Controllers\ClinicController;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Clinic;
use App\Models\Country;
use App\Models\Category;
use App\Models\State;
use App\Models\User;
use App\Models\Quote;
use App\Models\Portfolio;
use App\Models\Doctor;
use App\Models\SubCategory;
use Illuminate\Support\Facades\DB;

class ClinicDashboardController extends Controller
{
    public function index(Request $request)
    {
        // Get clinic_id from session
        $clinic_id = session('clinic_id');
    
        // Get the counts for quotes, portfolios, and doctors related to this clinic
        $quoteCount = Quote::where('clinic_id', $clinic_id)->count();
        $portfolioCount = Portfolio::where('clinic_id', $clinic_id)->count();
        $doctorCount = Doctor::where('clinic_id', $clinic_id)->count();
    
        // Get settings (if needed)
        $settings = Setting::first();
    
        // Pass all counts and settings to the view
        return view('clinic.dashboard.index', compact('settings', 'quoteCount', 'portfolioCount', 'doctorCount'));
    }
    


    // Show form to edit a clinic or create a new one if no session clinic_id
    public function edit()
    {
        // Check if clinic_id exists in session
        $clinic_id = session('clinic_id');

        // If clinic_id exists, find the clinic
        if ($clinic_id) {
            $clinic = Clinic::with('categories', 'subcategories')->findOrFail($clinic_id);
        } else {
            // If no clinic_id, create an empty clinic object to handle the create case
            $clinic = new Clinic();
        }

        // Load necessary data
        $countries = Country::all();
        $states = $clinic->country_id ? State::where('country_id', $clinic->country_id)->get() : collect();
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $users = User::where('user_type', 'clinic')->get();

        return view('clinic.edit', compact('clinic', 'countries', 'states', 'categories', 'subcategories', 'users'));
    }



    // Update or create a clinic
    public function update(Request $request)
    {
        // Check if clinic_id exists in session
        $clinic_id = session('clinic_id');

        // Validation
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'user_id' => 'required',
            'description' => 'nullable',
            'address' => 'nullable',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'map_embed_code' => 'nullable|string',
            'country_id' => 'required|exists:countries,id',
            'state_id' => 'required|exists:states,id',
            'categories' => 'required|array',
            'subcategories' => 'required|array',
        ]);

        // If clinic_id exists, find the clinic and update, otherwise create a new one
        if ($clinic_id) {
            $clinic = Clinic::findOrFail($clinic_id);
        } else {
            // Create a new clinic if no clinic_id in session
            $clinic = new Clinic();
        }

        // Handle main image upload
        if ($request->hasFile('main_image')) {
            $mainImage = $request->file('main_image');
            $mainImageName = time() . '.' . $mainImage->getClientOriginalExtension();
            $mainImage->move(public_path('storage/img'), $mainImageName);
            $clinic->main_image = $mainImageName;
        }

        // Handle multiple image upload
        if ($request->hasFile('gallery_images')) {
            $galleryImages = json_decode($clinic->gallery_images, true) ?? []; // Get current images or empty array
            foreach ($request->file('gallery_images') as $galleryImage) {
                $imageName = time() . rand(1, 1000) . '.' . $galleryImage->getClientOriginalExtension();
                $galleryImage->move(public_path('storage/img'), $imageName);
                $galleryImages[] = $imageName;
            }
            $clinic->gallery_images = json_encode($galleryImages);
        }

        // Update or create clinic details
        $clinic->name = $request->name;
        $clinic->email = $request->email;
        $clinic->description = $request->description;
        $clinic->address = $request->address;
        $clinic->map_embed_code = $request->map_embed_code;
        $clinic->country_id = $request->country_id;
        $clinic->state_id = $request->state_id;
        $clinic->user_id = $request->user_id;
        $clinic->save(); // Save the clinic (either update or create)

        // Sync categories and subcategories
        $clinic->categories()->sync($request->categories);
        $clinic->subcategories()->sync($request->subcategories);

        // If this was a creation, set the clinic_id in session
        if (!$clinic_id) {
            session(['clinic_id' => $clinic->id]);
        }

        return redirect()->route('clinics.clinics.edit')->with('success', 'Clinic updated successfully.');
    }


    public function deleteGalleryImage(Request $request, $id)
    {
        $clinic = Clinic::findOrFail($id);

        // Get the current gallery images
        $galleryImages = json_decode($clinic->gallery_images, true);

        // Find and remove the image from the array
        if (($key = array_search($request->image, $galleryImages)) !== false) {
            // Delete the image file from the public storage
            if (file_exists(public_path('storage/img/' . $request->image))) {
                unlink(public_path('storage/img/' . $request->image));
            }
            unset($galleryImages[$key]);
        }

        // Update the gallery images in the database
        $clinic->gallery_images = json_encode(array_values($galleryImages)); // Reindex the array
        $clinic->save();

        return response()->json(['success' => 'Image deleted successfully.']);
    }


}






