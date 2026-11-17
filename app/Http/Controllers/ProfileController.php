<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     */
    public function edit()
    {
        $user = Auth::user();
        
        if ($user->user_type == 'admin') {
            return view('profile');
        } elseif ($user->user_type == 'clinic') {
            return view('clinic_profile');
        }elseif ($user->user_type == 'patient') {
            return view('patient_profile');
        } else {
            return redirect()->back()->with('error', 'Unauthorized access.');
        }
    }
    


    public function update(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'phone' => 'nullable|string|max:15',
            'name' => 'required|string|max:100',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Update phone
        $user->phone = $validatedData['phone'];
        $user->name = $validatedData['name'];

        // Update profile image
        if ($request->hasFile('profile_image')) {
            // Delete the old image if it exists
            if ($user->profile_image) {
                Storage::delete('public/img/' . $user->profile_image);
            }

            // Store the new image
            $image = $request->file('profile_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('storage/img'), $imageName);
            $user->profile_image = $imageName;
        }

        // Save the user
        $user->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Profile updated successfully');
    }



    public function updateProfileImage(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:3072',
        ]);

        $user = Auth::user(); 

        
        if ($request->hasFile('profile_image')) {
        // Delete old image if exists

         if (File::exists(public_path($user->profile_image))) {
                File::delete(public_path($user->profile_image));
            }

        // Save new image
        $file = $request->file('profile_image');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/profile'), $filename);
        }

        // Update user
        $user->profile_picture = $filename;
        $user->save();

        return redirect()->back()->with('success', 'Profile image updated successfully!');


    }





}
