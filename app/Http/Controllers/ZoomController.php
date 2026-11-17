<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ZoomController extends Controller
{
    public function getOAuthUrl()
    {
        $clientId = env('ZOOM_CLIENT_ID');
        $redirectUri = env('ZOOM_REDIRECT_URI');
        $zoomUrl = "https://zoom.us/oauth/authorize?response_type=code&client_id={$clientId}&redirect_uri={$redirectUri}";

        return response()->json(['url' => $zoomUrl]);
    }

    public function handleCallback(Request $request)
    {
        // Check if the authorization code is present in the request
        if (!$request->has('code')) {
            return response()->json(['error' => 'Authorization code missing'], 400);
        }

        $code = $request->input('code');
        \Log::info("Received Zoom Authorization Code: $code");

        $client = new \GuzzleHttp\Client();
        

        try {
            // Step 1: Exchange authorization code for access token
            $tokenResponse = $client->post('https://zoom.us/oauth/token', [
                'form_params' => [
                    'grant_type' => 'authorization_code',
                    'code' => $code,
                    'redirect_uri' => env('ZOOM_REDIRECT_URI'),
                ],
                'headers' => [
                    'Authorization' => 'Basic ' . base64_encode(env('ZOOM_CLIENT_ID') . ':' . env('ZOOM_CLIENT_SECRET')),
                ],
            ]);

            $tokenData = json_decode($tokenResponse->getBody(), true);
            $accessToken = $tokenData['access_token'];

            \Log::info("Zoom Access Token: $accessToken");

            
            // Step 2: Use the access token to create a Zoom meeting
            $meetingResponse = $client->post('https://api.zoom.us/v2/users/me/meetings', [
                'headers' => [
                    'Authorization' => "Bearer $accessToken",
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'topic' => 'Test Meeting',
                    'type' => 1, // Instant Meeting
                ],
            ]);

            $meetingData = json_decode($meetingResponse->getBody(), true);

            // Return the meeting details as the response
            return response()->json($meetingData);

        } catch (\Exception $e) {
            \Log::error("Zoom API Error: " . $e->getMessage());
            return response()->json(['error' => 'Failed to create Zoom meeting'], 500);
        }
    }


    public function createMeeting(Request $request)
    {
        $accessToken = $request->header('Authorization'); // Pass token from frontend or database
        $client = new Client();

        $response = $client->post('https://api.zoom.us/v2/users/me/meetings', [
            'headers' => [
                'Authorization' => "Bearer $accessToken",
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'topic' => 'Test Meeting',
                'type' => 1, // Instant Meeting
            ],
        ]);

        return response()->json(json_decode($response->getBody(), true));
    }
}
