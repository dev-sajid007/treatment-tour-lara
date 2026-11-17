<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class APIAppointmentController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'clinic_id' => 'required|exists:clinics,id',
            'doctor_id' => 'required|exists:doctors,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'message' => 'nullable|string',
        ]);

        // Create the appointment
        $appointment = Appointment::create($validatedData);

        // Get the business email from the environment or settings
        $businessEmail = env('BUSINESS_EMAIL');

        // Send email to the business email
        Mail::raw("New Appointment Created\n\nName: {$appointment->name}\nEmail: {$appointment->email}\nPhone: {$appointment->phone}\nAddress: {$appointment->address}\nMessage: {$appointment->message}", function ($message) use ($businessEmail, $appointment) {
            $message->to($businessEmail)
                    ->subject('New Appointment Created')
                    ->from($appointment->email);  // Use client's email as the sender
        });

        return response()->json(['message' => 'Appointment created successfully and email sent', 'appointment' => $appointment], 201);
    }
}
