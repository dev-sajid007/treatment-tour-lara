<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Log;

class SSLCommerzService
{
    public function initiatePayment($amount, $doctorId)
    {
        $url = 'https://sandbox.sslcommerz.com/gwprocess/v4/api.php'; // Change for production

        $postData = [
            'store_id' => env('SSLCOMMERZ_STORE_ID'),
            'store_password' => env('SSLCOMMERZ_STORE_PASSWORD'),
            'total_amount' => $amount,
            'currency' => 'BDT',
            'tran_id' => uniqid('TXN_'),
            'success_url' => route('payment.success'),
            'fail_url' => route('payment.fail'),
            'cancel_url' => route('payment.cancel'),
            'cus_name' => 'John Doe',
            'cus_email' => 'johndoe@example.com',
            'cus_phone' => '+8801722222222',
            'cus_add1' => 'Dhaka',
            'cus_add2' => 'Bangladesh',
        ];

        $response = Http::asForm()->post($url, $postData);

        Log::info("sslcommerz response: $response");
        $data = $response->json();

        if ($data['status'] === 'SUCCESS') {
            return redirect($data['GatewayPageURL']);
        }

        return redirect()->route('payment.error');
    }

    public function handleSuccess(Request $request)
    {
        // Handle success logic
        return redirect()->route('payment.success');
    }

    public function handleFailure(Request $request)
    {
        // Handle failure logic
        return redirect()->route('payment.error');
    }

    public function handleCancel(Request $request)
    {
        // Handle cancel logic
        return redirect()->route('payment.error');
    }
}
