<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Client; // Assuming you have a Client model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


class AppointmentController extends Controller
{
    public function appointmentsList()
    {
        // Fetch all appointments along with related client and doctor data
        $appointments = Appointment::with('clinic', 'doctor')->get();

        return view('admin.appointments.index', compact('appointments'));
    }

    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return redirect()->route('admin.appointments.list')->with('success', 'Appointment deleted successfully.');
    }


public function sendEmail(Request $request)
{
    try {
        // Validate the input data
        $request->validate([
            'doctor_email' => 'required|email',
            'clinic_email' => 'required|email',
            'client_name' => 'required|string',
            'client_email' => 'required|email',
            'client_phone' => 'required|string',
            'client_address' => 'required|string',
            'message' => 'required|string',
        ]);

        $doctorEmail = $request->doctor_email;
        $clinicEmail = $request->clinic_email;
        $clientName = $request->client_name;
        $clientEmail = $request->client_email;
        $clientPhone = $request->client_phone;
        $clientAddress = $request->client_address;
        $appointmentMessage = $request->message;

        // Construct the email content
        $emailContent = "New Appointment from TreatmentTour:\n\n" .
                        "Client Name: $clientName\n" .
                        "Client Email: $clientEmail\n" .
                        "Client Phone: $clientPhone\n" .
                        "Client Address: $clientAddress\n\n" .
                        "Message: $appointmentMessage";

        // Send email to the doctor and clinic
        Mail::raw($emailContent, function ($message) use ($doctorEmail, $clinicEmail) {
            $message->to($doctorEmail)->subject('Appointment Notification');
            $message->cc($clinicEmail)->subject('Appointment Notification');
            $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME')); // Set the sender's email and name
        });

        return response()->json(['success' => true]);
    } catch (\Illuminate\Validation\ValidationException $e) {
        Log::error('Validation Error: ', $e->errors());
        return response()->json(['error' => 'Invalid input data', 'details' => $e->errors()], 422);
    } catch (\Swift_TransportException $e) {
        Log::error('Mail Transport Error: ' . $e->getMessage());
        return response()->json(['error' => 'Failed to send email', 'details' => $e->getMessage()], 500);
    } catch (\Exception $e) {
        Log::error('General Error: ' . $e->getMessage());
        return response()->json(['error' => 'An unexpected error occurred', 'details' => $e->getMessage()], 500);
    }
}


    

}
