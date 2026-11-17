<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ZoomService;
use App\Models\Meeting;
use Auth;
use Carbon\Carbon;

class ZoomController extends Controller
{
    protected $zoomService;


    public function __construct(ZoomService $zoomService)
    {
        $this->zoomService = $zoomService;
    }

    // Show the Zoom Meetings page with a list of meetings
    public function index()
    {
        //$meetings = $this->zoomService->listMeetings();
       // dd($meetings);
        $auth = Auth::user()->id;
        $meetings = Meeting::where('doctor_id', $auth)->get();

        return view('api.zoom.index', compact('meetings'));
    }

    // Handle meeting creation from a form submission
    public function createMeeting(Request $request)
    {
        $request->validate([
            'topic' => 'required|string',
            'start_time' => 'required|date',
            'duration' => 'required|integer',
            'password' => 'nullable|string'
        ]);

        $meeting = $this->zoomService->createMeeting(
            $request->topic,
            $request->start_time,
            $request->duration,
            'Asia/Dhaka',
            $request->password ?? '123456'
        );



        //dd($meeting);


     // Ensure the Zoom API response is valid
    if (!$meeting || !isset($meeting['id'], $meeting['join_url'], $meeting['start_url'])) {
        return redirect()->back()->with('error', 'Failed to create Zoom meeting.');
    }

    // Store meeting details in the database
    $meet = new Meeting();
    $meet->doctor_id = Auth::id();
    $meet->topic = $meeting['topic']; // Use API response
    $meet->patient_id = $request->patient_id;
    $meet->appointment_id = $request->appointment_id;
    $meet->meeting_id = $meeting['id']; 
    $meet->host_email = $meeting['host_email'];
    $meet->join_url = $meeting['join_url']; 
    $meet->start_url = $meeting['start_url']; 
    $meet->duration = $meeting['duration'];
    $meet->start_time = Carbon::parse($meeting['start_time'])->format('Y-m-d H:i:s');
    $meet->status = 'scheduled'; // Fixed status value
    $meet->password = $meeting['password'] ?? '123456'; // Store password
    $meet->save();


        //return redirect()->route('zoom.index')->with('success', 'Meeting Created Successfully!');
    return redirect()->back()->with('success', 'Meeting Created Successfully!');
    }

    // Handle meeting deletion
    public function deleteMeeting($id)
    {
        $this->zoomService->deleteMeeting($id);
        return redirect()->route('zoom.index')->with('success', 'Meeting Deleted Successfully!');
    }

}
