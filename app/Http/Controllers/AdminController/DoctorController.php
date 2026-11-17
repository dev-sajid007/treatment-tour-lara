<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Clinic;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    // Show doctors page
    public function index($clinic_id)
    {
        $clinic = Clinic::findOrFail($clinic_id);
        $doctors = Doctor::where('clinic_id', $clinic_id)->get();

        return view('admin.doctors.index', compact('clinic', 'doctors'));
    }

    // Store a new doctor
    public function store(Request $request, $clinic_id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'experience_years' => 'required|integer',
            'spoken_languages' => 'required|string',
            'associations' => 'nullable',
            'education' => 'nullable',
            'image' => 'nullable',
        ]);

        $imageName = null;

        // Handle image upload
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('storage/doctors'), $imageName);
        }

        // Create the doctor
        Doctor::create([
            'clinic_id' => $clinic_id,
            'name' => $request->name,
            'email' => $request->email,
            'image' => $imageName,
            'experience_years' => $request->experience_years,
            'spoken_languages' => $request->spoken_languages,
            'associations' => $request->associations,
            'education' => $request->education,
        ]);

        return redirect()->route('admin.doctors.index', $clinic_id)->with('success', 'Doctor added successfully.');
    }

    // Update doctor
    public function update(Request $request, $doctor_id)
    {
        $doctor = Doctor::findOrFail($doctor_id);

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'experience_years' => 'required|integer',
            'spoken_languages' => 'required|string',
            'associations' => 'nullable',
            'education' => 'nullable',
            'image' => 'nullable',
        ]);

        // Handle image upload if updated
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('storage/doctors'), $imageName);
            $doctor->image = $imageName;
        }

        $doctor->update([
            'name' => $request->name,
            'email' => $request->email,
            'experience_years' => $request->experience_years,
            'spoken_languages' => $request->spoken_languages,
            'associations' => $request->associations,
            'education' => $request->education,
        ]);

        return redirect()->route('admin.doctors.index', $doctor->clinic_id)->with('success', 'Doctor updated successfully.');
    }

    // Delete doctor
    public function destroy($doctor_id)
    {
        $doctor = Doctor::findOrFail($doctor_id);

        // Delete image from storage
        if ($doctor->image && file_exists(public_path('storage/doctors/' . $doctor->image))) {
            unlink(public_path('storage/doctors/' . $doctor->image));
        }

        $doctor->delete();

        return redirect()->back()->with('success', 'Doctor deleted successfully.');
    }
}
