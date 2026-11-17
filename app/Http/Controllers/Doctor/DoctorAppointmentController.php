<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient\PatientAppointment;
use App\Models\Doctor\Prescription;
use Auth;

class DoctorAppointmentController extends Controller
{
   
    public function index()
    {
       $authId = Auth::user()->id;
       $appointments = PatientAppointment::where('doctor_id', $authId)->latest()->get();
       return view('doctor.appointments.index', compact('appointments'));
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

        $appointment = PatientAppointment::findOrFail($id);



        $appointment->status = $request->status;
        
        // Save the updated appointment
        $appointment->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Appointment updated successfully!');
    }



}
