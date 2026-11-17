<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\User;
use App\Models\Clinic;
use App\Models\State;
use Illuminate\Http\Request;

class APIDoctorController extends Controller
{
     public function index()
    {
        $usersWithDoctors = User::has('doctor')->with('doctor')->get();
        return response()->json($usersWithDoctors, 200);
    }
 
    // public function index($clinicId)
    // {
    //     // Manually fetch the clinic by its ID
    //     $clinic = Clinic::findOrFail($clinicId);
    // 
    //     // Get all doctors associated with the clinic
    //     $doctors = $clinic->doctors()->get();
    // 
    //     // Return the data as JSON
    //     return response()->json($doctors);
    // }
    // 
    


    public function store(Request $request, Clinic $clinic)
    {
        $request->validate([
            'name' => 'required',
            'experience_years' => 'required|integer',
            'spoken_languages' => 'required|string',
            'associations' => 'nullable',
            'education' => 'nullable',
        ]);
      
        return $clinic->doctors()->create($request->all());
    }

    public function show(Clinic $clinic, Doctor $doctor)
    {
        return $doctor;
    }

    public function update(Request $request, Clinic $clinic, Doctor $doctor)
    {
        $request->validate([
            'name' => 'required',
            'experience_years' => 'required|integer',
            'spoken_languages' => 'required|string',
            'associations' => 'nullable',
            'education' => 'nullable',
        ]);

        $doctor->update($request->all());

        return $doctor;
    }

    public function destroy(Clinic $clinic, Doctor $doctor)
    {
        $doctor->delete();

        return response(null, 204);
    }

    // filtering doctors by state
    public function doctorByCountry($country)
    {
        $usersWithDoctorsByState = User::whereHas('doctor', function ($query) use ($country) {
            $query->where('state', $country);
        })->with('doctor')->get();

        
            return response()->json($usersWithDoctorsByState, 200);
    }

    public function doctorByState($state)
    {
        $usersWithDoctorsByCity = User::whereHas('doctor', function ($query) use ($state) {
            $query->where('city', $state);
        })->with('doctor')->get();

        return response()->json($usersWithDoctorsByCity, 200);
    }

    public function cityByState($countryId)
    {
        $city = State::where('country_id', $countryId)->get();
        return response()->json($city, 200);
    }

    public function getDoctorById($Id)
    {
        $doctorById = User::whereHas('doctor', function ($query) use ($Id) {
            $query->where('user_id', $Id);
        })->with('doctor')->get();

        return response()->json($doctorById, 200);
    }

}
