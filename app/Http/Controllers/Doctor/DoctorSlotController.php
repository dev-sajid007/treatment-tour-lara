<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor\DoctorSlot;
use Auth;

class DoctorSlotController extends Controller
{

    public function index()
    {
        $doctorSlots = DoctorSlot::all();
        return view('doctor.slots.index', compact('doctorSlots'));
    }


    public function create()
    {
        return view('doctor.slots.create');
    }


    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'day_of_week' => 'required|in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'max_patients' => 'nullable|integer|min:1',
            'status' => 'required|in:active,inactive',
        ]);

        $validated['doctor_id'] = auth()->id(); // Use the authenticated user's ID as the doctor_id

        DoctorSlot::create($validated);

        return redirect()->back()->with('success', 'Doctor slot created successfully');
    }



    public function show(DoctorSlot $doctorSlot)
    {
        return response()->json($doctorSlot);
    }


    public function edit(DoctorSlot $doctorSlot)
    {
        
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());
        // Validate the request data
        $validated = $request->validate([
            'day_of_week' => 'nullable',
            'start_time' => 'required',
            'end_time' => 'required',
            'max_patients' => 'nullable',
            'status' => 'required',
        ]);

        // Find the DoctorSlot instance by ID
        $doctorSlot = DoctorSlot::findOrFail($id);

        // Update the DoctorSlot with the validated data
        $doctorSlot->update($validated);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Doctor slot updated successfully');
    }



    public function destroy($id)
    {
        $doctorSlot = DoctorSlot::find($id);
        $doctorSlot->delete();
        return redirect()->back()->with('success', 'Doctor slot deleted successfully');
    }


}
