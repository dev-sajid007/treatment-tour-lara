<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Models\Clinic;
use App\Models\Country;
use App\Models\Category;
use App\Models\State;
use App\Models\User;
use App\Models\SubCategory;
use App\Models\Speciality;
use App\Models\Clinic\ClinicSetting;
use Illuminate\Http\Request;

class ClinicController extends Controller
{
    // Display list of clinics
    public function index()
    {
        $clinics = Clinic::with('country', 'state', 'categories', 'subcategories')->get(); // Eager load relationships
        //$users = User::where('user_type', 'clinic')->get();
        return view('admin.clinics.index', compact('clinics'));
    }

   // Show clinic details
   public function show($id)
   {
       $clinic = Clinic::with('country', 'state', 'categories', 'subcategories')->findOrFail($id);
       $clinicSettings = ClinicSetting::where('clinic_id', $clinic->id)->first();
       return view('admin.clinics.show', compact('clinic', 'clinicSettings'));
   }

    // Show form to create a new clinic
    public function create()
    {
        $countries = Country::all();
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $users = User::role('clinic')->get();
        return view('admin.clinics.create', compact('countries', 'categories', 'subcategories', 'users'));
    }

    // Store a new clinic
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            //'user_id' => 'required',
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

        // Handle main image upload
        $mainImagePath = null;
        if ($request->hasFile('main_image')) {
            $mainImage = $request->file('main_image');
            $mainImageName = time() . '.' . $mainImage->getClientOriginalExtension();
            $mainImage->move(public_path('storage/img'), $mainImageName);
            $mainImagePath = $mainImageName;
        }

        // Handle multiple image upload
        $galleryImages = [];
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $galleryImage) {
                $imageName = time() . rand(1, 1000) . '.' . $galleryImage->getClientOriginalExtension();
                $galleryImage->move(public_path('storage/img'), $imageName);
                $galleryImages[] = $imageName;
            }
        }

        // Create the clinic
        $clinic = Clinic::create([
            'name' => $request->name,
            'email' => $request->email,
            'description' => $request->description,
            'address' => $request->address,
            'main_image' => $mainImagePath,
            'gallery_images' => json_encode($galleryImages),
            'map_embed_code' => $request->map_embed_code,
            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
            //'user_id' => $request->user_id,
        ]);

        // Attach categories and subcategories
        $clinic->categories()->attach($request->categories);
        $clinic->subcategories()->attach($request->subcategories);

        return redirect()->route('admin.clinics.index')->with('success', 'Clinic created successfully.');
    }

     // Show form to edit a clinic
     public function edit($id)
     {
         $clinic = Clinic::with('categories', 'subcategories')->findOrFail($id);
         $countries = Country::all();
         $states = State::where('country_id', $clinic->country_id)->get(); // Get states based on country
         $categories = Category::all();
         $subcategories = SubCategory::all();
         $specialities = speciality::all();
         $users = User::where('clinic_id', $clinic->id)->get();
         return view('admin.clinics.edit', compact('clinic', 'countries', 'states', 'categories', 'subcategories', 'users', 'specialities'));
     }

    // Update a clinic
    public function update(Request $request, $id)
    {
        $clinic = Clinic::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            //'user_id' => 'required',
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


        // Update clinic details
        $clinic->update([
            'name' => $request->name,
            'email' => $request->email,
            'description' => $request->description,
            'address' => $request->address,
            'map_embed_code' => $request->map_embed_code,
            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
            'user_id' => $request->user_id,
        ]);

        // Sync categories and subcategories
        $clinic->categories()->sync($request->categories);
        $clinic->subcategories()->sync($request->subcategories);
        $clinic->specialities()->sync($request->specialities);

        return redirect()->route('admin.clinics.index')->with('success', 'Clinic updated successfully.');
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


    // Delete a clinic
    public function destroy($id)
    {
        $clinic = Clinic::findOrFail($id);
        if ($clinic->main_image) {
            unlink(public_path('storage/img/' . $clinic->main_image));
        }
        if ($clinic->gallery_images) {
            foreach (json_decode($clinic->gallery_images) as $image) {
                unlink(public_path('storage/img/' . $image));
            }
        }
        $clinic->delete();
        return redirect()->route('admin.clinics.index')->with('success', 'Clinic deleted successfully.');
    }


     // Fetch states based on selected country
     public function getStatesByCountry($country_id)
     {
         // Fetch states where country_id matches the selected country
         $states = State::where('country_id', $country_id)->get();
 
         // Create the options HTML for the state dropdown
         $options = '<option value="">Select a state</option>';
         foreach ($states as $state) {
             $options .= '<option value="' . $state->id . '">' . $state->name . '</option>';
         }
 
         // Return the options as a response
         return response()->json($options);
     }
}
