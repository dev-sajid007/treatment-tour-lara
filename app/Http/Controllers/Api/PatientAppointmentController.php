<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient\PatientAppointment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PatientAppointmentController extends Controller
{
     public function index()
    {
        $appointments = PatientAppointment::with(['patient', 'doctor', 'clinic', 'hospital'])->get();
        return response()->json($appointments, 200);
    }

    public function store(Request $request)
{
    try {
        // Log the incoming request data for debugging
        Log::info('Appointment request data: ', $request->all());

        // Validate other fields, but do not require 'patient_id' from the request
        $request->validate([
            'doctor_id' => 'nullable|exists:users,id',
            //'clinic_id' => 'nullable|exists:clinics,id',
            //'hospital_id' => 'nullable|exists:hospitals,id',
            'patient_id' => 'nullable|exists:users,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'reason' => 'nullable|string',
        ]);


        $appointmentData = $request->all();
        //$appointmentData['patient_id'] = $patient_id;

        // Log the final appointment data before storing
        Log::info('Appointment data to be stored: ', $appointmentData);

        // Create the appointment with the patient_id from Auth::user()
        $appointment = PatientAppointment::create($appointmentData);

        return response()->json([
            'success' => true,
            'message' => 'Appointment created successfully',
            'appointment' => $appointment
        ], 201);

    } catch (\Illuminate\Validation\ValidationException $e) {
        // Log validation errors for debugging
        Log::error('Validation error: ', $e->errors());
        
        return response()->json([
            'success' => false,
            'message' => 'Validation Error',
            'errors' => $e->errors()
        ], 422);
    } catch (\Exception $e) {
        // Log the general exception error
        Log::error('Error creating appointment: ', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);

        return response()->json([
            'success' => false,
            'message' => 'An error occurred while creating the appointment',
            'error' => $e->getMessage()
        ], 500);
    }
}



    public function show($id)
    {
        $appointment = PatientAppointment::with(['patient', 'doctor', 'clinic', 'hospital'])->find($id);

        if (!$appointment) {
            return response()->json(['message' => 'Appointment not found'], 404);
        }

        return response()->json($appointment, 200);
    }

    public function update(Request $request, $id)
    {
        $appointment = PatientAppointment::find($id);

        if (!$appointment) {
            return response()->json(['message' => 'Appointment not found'], 404);
        }

        $request->validate([
            'patient_id' => 'nullable|exists:users,id',
            'doctor_id' => 'nullable|exists:users,id',
            'clinic_id' => 'nullable|exists:clinics,id',
            'hospital_id' => 'nullable|exists:hospitals,id',
            'appointment_date' => 'nullable|date',
            'appointment_time' => 'nullable',
            'reason' => 'nullable|string',
            'status' => 'nullable|in:scheduled,completed,canceled',
        ]);

        $appointment->update($request->all());

        return response()->json([
            'message' => 'Appointment updated successfully',
            'appointment' => $appointment
        ], 200);
    }


    public function destroy($id)
    {
        $appointment = PatientAppointment::find($id);

        if (!$appointment) {
            return response()->json(['message' => 'Appointment not found'], 404);
        }

        $appointment->delete();

        return response()->json(['message' => 'Appointment deleted successfully'], 200);
    }



}
