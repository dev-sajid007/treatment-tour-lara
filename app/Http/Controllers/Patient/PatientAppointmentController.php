<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient\PatientAppointment;
use Auth;

class PatientAppointmentController extends Controller
{

    public function index()
    {
       $authId = Auth::user()->id;
       $appointments = PatientAppointment::where('patient_id', $authId)->latest()->get();
       return view('patient.appointments.index', compact('appointments'));
    }


    public function create()
    {
      
    }


    public function store(Request $request)
    {
       
    }


    public function show(string $id)
    {
      
    }


    public function edit(string $id)
    {
       
    }

    
    
     public function update(Request $request, $id)
    {
        // Validate the incoming data

        //dd($id);
        // $request->validate([
        //     'appointment_date' => 'required|date',
        //     'appointment_time' => 'required|date_format:H:i',
        //     'status' => 'required|in:scheduled,completed,canceled',
        // ]);

        // Find the appointment by ID
        $appointment = PatientAppointment::findOrFail($id);

        // Update the appointment with the validated data
        $appointment->appointment_date = $request->input('appointment_date');
        $appointment->appointment_time = $request->input('appointment_time');
        $appointment->status = 'scheduled';
        
        // Save the updated appointment
        $appointment->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Appointment updated successfully!');
    }





    public function destroy(string $id)
    {
        //
    }
}
