<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient\PatientHistory;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class PatientHistoryController extends Controller
{
    //  public function index()
    // {
    //     // Get all patient histories
    //     $patientHistories = PatientHistory::all();
    //     return view('patient_histories.index', compact('patientHistories'));
    // }


    public function create()
    {
        $patientHistory = PatientHistory::where('patient_id', auth()->user()->id)->first();
        $user = Auth::user();
        return view('patient.patient_histories.create', compact('patientHistory', 'user'));
    }


    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
     
            'guardian_name' => 'nullable|max:255',
            'guardian_relationship' => 'nullable|max:255',
            'guardian_contact_number' => 'nullable|max:15',
            'guardian_email' => 'nullable|email',
            'medical_conditions' => 'nullable',
            'medications' => 'nullable',
            'allergies' => 'nullable',
            'surgical_history' => 'nullable',
            'family_history' => 'nullable',
            'social_history' => 'nullable',
            'vaccination_history' => 'nullable',
            'disease_history' => 'nullable',
            'past_treatments' => 'nullable',
            'mental_health_history' => 'nullable',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->date_of_birth = $request->date_of_birth;
        $user->save();

        // Automatically associate the patient's ID with the authenticated user's ID
        $patientHistoryData = $request->all();
        $patientHistoryData['patient_id'] = Auth::id();  // Set the patient_id to the authenticated user's ID

        // Create the patient history record
        PatientHistory::create($patientHistoryData);

        return redirect()->route()->with('success', 'Patient history created successfully');
    }


    public function show(PatientHistory $patientHistory)
    {
        return view('patient_histories.show', compact('patientHistory'));
    }


    public function edit(PatientHistory $patientHistory)
    {
        return view('patient.patient_histories.edit', compact('patientHistory'));
    }

    public function update(Request $request, $id)
    {
        // Validate input data
        $request->validate([
            'guardian_name' => 'nullable|string|max:255',
            'guardian_relationship' => 'nullable|string|max:255',
            'guardian_contact_number' => 'nullable|string|max:15',
            'guardian_email' => 'nullable|email',
            'medical_conditions' => 'nullable|string',
            'medications' => 'nullable|string',
            'allergies' => 'nullable|string',
            'surgical_history' => 'nullable|string',
            'family_history' => 'nullable|string',
            'social_history' => 'nullable|string',
            'vaccination_history' => 'nullable|string',
            'disease_history' => 'nullable|string',
            'past_treatments' => 'nullable|string',
            'mental_health_history' => 'nullable|string',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->date_of_birth = $request->date_of_birth;
        $user->save();

        // Fetch the patient history record
        $patientHistory = PatientHistory::findOrFail($id);

        // Update the record with new data
        $patientHistory->update($request->all());

        return redirect()->back()->with('success', 'Patient history updated successfully');
    }


    public function destroy(PatientHistory $patientHistory)
    {
        $patientHistory->delete();
        return redirect()->route('patient_histories.index')->with('success', 'Patient history deleted successfully');
    }
}
