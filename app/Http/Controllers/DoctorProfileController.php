<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor\DoctorProfile;
use App\Models\Country;
use App\Models\State;
use App\Models\Category;
use Auth;

class DoctorProfileController extends Controller
{

    public function index()
    {
        $auth = auth::user();
        $profile = DoctorProfile::with(['country', 'state', 'user'])->where('user_id', $auth->id)->first();
        $countries = Country::all();
        $states = State::all();
        $categories = Category::all();
        return view('doctor.profiles.index', compact('profile', 'countries', 'states', 'auth', 'categories'));
    }


    public function create()
    {
        $countries = Country::all();
        $states = State::all();
        $categories = Category::all();
        return view('doctor.profiles.create', compact('countries', 'states', 'categories'));
    }


    public function store(Request $request)
    {


        $request->validate([
            'country_id' => 'required|exists:countries,id',
            'state_id' => 'nullable|exists:states,id',
            'user_id' => 'nullable|exists:users,id',
            'category_id' => 'nullable|exists:categories,id',
            'city' => 'nullable',
            'address' => 'nullable',
            'postal_code' => 'nullable|',
            'specialization' => 'nullable|',
            'bio' => 'nullable|string',
            'qualification' => 'nullable',
            'license_number' => 'nullable|',
            'profile_picture' => 'nullable',
            'consultation_fee' => 'nullable',
            'availability_status' => 'nullable',
        ]);



        $profile = new DoctorProfile();
        $profile->country_id = $request->country_id;
        $profile->state_id = $request->state_id;
        $profile->category_id = $request->category_id;
        $profile->user_id = auth::user()->id;
        $profile->city = $request->city;
        $profile->address = $request->address;
        $profile->postal_code = $request->postal_code;
        $profile->specialization = $request->specialization;
        $profile->bio = $request->bio;
        $profile->qualification = $request->qualification;
        $profile->license_number = $request->license_number;
        $profile->consultation_fee = $request->consultation_fee;
        $profile->availability_status = $request->availability_status;

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/profile_pictures'), $fileName); // Save in public/uploads/profile_pictures

            $profile->profile_picture = 'uploads/profile_pictures/' . $fileName;
        }

        $profile->save();


        return redirect()->route('doctor-profiles.index')->with('success', 'You have added profile.');
        
    }


    public function show($id)
    {
        $profile = DoctorProfile::with(['country', 'state', 'user'])->findOrFail($id);
        return response()->json($profile);
    }


    public function edit($id)
    {
        $countries = Country::all();
        $states = State::all();
        $categories = Category::all();
        $doctor = DoctorProfile::findOrFail($id);
   
        return view('doctor.profiles.edit', compact('countries', 'states', 'categories', 'doctor'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'country_id' => 'required|exists:countries,id',
            'state_id' => 'nullable|exists:states,id',
            'city' => 'nullable',
            'address' => 'nullable',
            'postal_code' => 'nullable',
            'specialization' => 'nullable',
            'bio' => 'nullable|string',
            'qualification' => 'nullable',
            'license_number' => 'nullable',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'consultation_fee' => 'nullable|numeric',
            'availability_status' => 'nullable|in:available,not_available',
        ]);

        // Find the profile
        $profile = DoctorProfile::findOrFail($id);

        // Update fields
        $profile->country_id = $request->country_id;
        $profile->state_id = $request->state_id;
        $profile->category_id = $request->category_id;
        $profile->city = $request->city;
        $profile->address = $request->address;
        $profile->postal_code = $request->postal_code;
        $profile->specialization = $request->specialization;
        $profile->bio = $request->bio;
        $profile->qualification = $request->qualification;
        $profile->license_number = $request->license_number;
        $profile->consultation_fee = $request->consultation_fee;
        $profile->availability_status = $request->availability_status;

        // Handle profile picture update
        if ($request->hasFile('profile_picture')) {
            // Delete old profile picture if it exists
            if ($profile->profile_picture && file_exists(public_path($profile->profile_picture))) {
                unlink(public_path($profile->profile_picture));
            }

            $file = $request->file('profile_picture');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/profile_pictures'), $fileName);

            $profile->profile_picture = 'uploads/profile_pictures/' . $fileName;
        }

        $profile->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }



    public function destroy($id)
    {
        $profile = DoctorProfile::findOrFail($id);
        $profile->delete();

        return response()->json(['message' => 'Doctor profile deleted successfully']);
    }
}
