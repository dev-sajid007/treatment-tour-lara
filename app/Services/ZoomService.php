<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ZoomService
{
    private $baseUrl;
    private $token;

    public function __construct()
    {
        $this->baseUrl = env('ZOOM_BASE_URL');
        $this->token = $this->generateAccessToken();
    }

    // Generate Zoom OAuth Access Token
    private function generateAccessToken()
    {
        $response = Http::asForm()->withHeaders([
            'Authorization' => 'Basic ' . base64_encode(env('ZOOM_CLIENT_ID') . ':' . env('ZOOM_CLIENT_SECRET')),
        ])->post('https://zoom.us/oauth/token', [
            'grant_type' => 'account_credentials',
            'account_id' => env('ZOOM_ACCOUNT_ID'),
        ]);

       // \Log::info('Zoom Token Response', $response->json());

        return $response->json()['access_token'] ?? null;
    }




    // Create a Zoom Meeting
    public function createMeeting($topic, $startTime, $duration, $timezone, $password)
    {
        $response = Http::withToken($this->token)
            ->post("{$this->baseUrl}/users/me/meetings", [
                'topic'      => $topic,
                'type'       => 2, // Scheduled meeting
                'start_time' => $startTime,
                'duration'   => $duration,
                'timezone'   => $timezone,
                'password'   => $password,
                'settings'   => [
                    'host_video'       => true,
                    'participant_video'=> true,
                    'waiting_room'     => true,
                ]
            ]);

        return $response->json();
    }

    // Get List of Meetings
    public function listMeetings()
    {
        $url = "https://api.zoom.us/v2/users/me/meetings";

        $response = Http::withHeaders([
            "Authorization" => "Bearer " . $this->token, // Use $this->token instead
            "Content-Type" => "application/json"
        ])->get($url);

        if ($response->failed()) {
            return ['error' => 'Failed to fetch meetings', 'details' => $response->json()];
        }

        return $response->json();
    }

    // Delete a Meeting
    public function deleteMeeting($meetingId)
    {
        $response = Http::withToken($this->token)
            ->delete("{$this->baseUrl}/meetings/{$meetingId}");

        return $response->json();
    }
}
