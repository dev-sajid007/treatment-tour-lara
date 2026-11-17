<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PayPalService; 
use App\Services\SSLCommerzService; 
use App\Models\Doctor\DoctorProfile;
use App\Models\User;
use App\Models\Appointment;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    protected $paypalService;
    protected $sslcommerzservice;
    public function __construct(PayPalService $paypalService, SSLCommerzService $sslcommerzservice)
    {
        $this->paypalService = $paypalService;
        $this->sslCommerzService = $sslcommerzservice;
    }


    public function payWithPayPal($doctorId)
    { 
        Log::info("Starting PayPal payment process for doctor ID: $doctorId");

        $doctor = User::findOrFail($doctorId);

        $doctor_profile = DoctorProfile::where('user_id', $doctor->id)->first(); 

        $amount = $doctor_profile->consultation_fee; 

        

        // Log the doctor ID and consultation fee
        Log::info("Processing PayPal payment for doctor ID: $doctorId");
        Log::info("Doctor's consultation fee: $amount");

        return $this->paypalService->createPayment($amount, $doctorId); 
    }

    public function successPayPal(Request $request)
    {
        $paymentId = $request->get('paymentId');
        $payerId = $request->get('PayerID');
        $doctorId = $request->get('doctor_id');




        return $this->paypalService->executePayment($paymentId, $payerId, $doctorId); 
    }

    // PayPal payment cancel handler
    public function cancelPayPal()
    {
        return redirect()->route('payment.error')->with('message', 'Payment cancelled.');
    }


    public function payWithSSLCommerz($doctorId)
    {
        $doctor = User::findOrFail($doctorId);

        $doctor_profile = DoctorProfile::where('user_id', $doctor->id)->first(); 

        $amount = $doctor_profile->consultation_fee; 


        return $this->sslCommerzService->initiatePayment($amount, $doctorId);
    }

    public function successSSLCommerz(Request $request)
    {
        return $this->sslCommerzService->handleSuccess($request);
    }

    public function failSSLCommerz(Request $request)
    {
        return $this->sslCommerzService->handleFailure($request);
    }

    public function cancelSSLCommerz(Request $request)
    {
        return $this->sslCommerzService->handleCancel($request);
    }




    public function failPayment()
    {
        Log::info("Payment failed.");

        // You can also return a view for payment failure

        return redirect()->back()->with('message', 'Payment failed. Please try again later.');

    }



}
