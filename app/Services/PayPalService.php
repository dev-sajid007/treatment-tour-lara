<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PayPalService
{
    protected $clientId;
    protected $clientSecret;
    protected $baseUrl;

    public function __construct()
    {
        $this->clientId = env('PAYPAL_CLIENT_ID');
        $this->clientSecret = env('PAYPAL_SECRET');
        $this->baseUrl = 'https://api.sandbox.paypal.com';  // For production, change to live URL
    }

    // Get Access Token
    public function getAccessToken()
    {
        $response = Http::withBasicAuth($this->clientId, $this->clientSecret)
                        ->asForm()
                        ->post("{$this->baseUrl}/v1/oauth2/token", [
                            'grant_type' => 'client_credentials',
                        ]);

        $data = $response->json();
        return $data['access_token'];
    }

    // Create payment
    public function createPayment($amount, $doctorId)
    {
        $accessToken = $this->getAccessToken();

        $response = Http::withToken($accessToken)
                        ->post("{$this->baseUrl}/v1/payments/payment", [
                            "intent" => "sale",
                            "payer" => [
                                "payment_method" => "paypal"
                            ],
                            "transactions" => [
                                [
                                    "amount" => [
                                        "total" => $amount,
                                        "currency" => "USD",
                                    ],
                                    "description" => "Consultation fee for doctor #$doctorId"
                                ]
                            ],
                            "redirect_urls" => [
                                "return_url" => route('payment.success', ['doctor_id' => $doctorId]),
                                "cancel_url" => route('payment.cancel'),
                            ]
                        ]);

        $data = $response->json();
        $approvalUrl = collect($data['links'])->firstWhere('rel', 'approval_url')['href'];

        return redirect($approvalUrl);
    }

    // Execute payment
    public function executePayment($paymentId, $payerId, $doctorId)
    {
        $accessToken = $this->getAccessToken();

        $response = Http::withToken($accessToken)
                        ->post("{$this->baseUrl}/v1/payments/payment/{$paymentId}/execute", [
                            "payer_id" => $payerId
                        ]);

        $data = $response->json();

        if ($data['state'] == 'approved') {
            // Update appointment status and associate with the doctor
            $appointment = Appointment::create([
                'doctor_id' => $doctorId,
                'appointment_date' => request('appointment_date'),
                'appointment_time' => request('appointment_time'),
                'reason' => request('reason'),
                'status' => 'confirmed',
            ]);
            return redirect()->route('appointment.success');
        }

        return redirect()->route('payment.error');
    }
}
