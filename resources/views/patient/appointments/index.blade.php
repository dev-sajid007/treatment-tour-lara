@extends('layouts.admin')

@section('content')



<div class="container-fluid">
   <div class="card border-0 p-4">
    <h2>Patient Appointments</h2>

    <!-- Table displaying the appointments -->
    <div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Patient Name</th>
                <th>Doctor Name</th>
                <th>Appointment Date</th>
                <th>Appointment Time</th>
                <th>Zoom Link</th>
                <th>Prescription</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($appointments as $appointment)

            @php
                //use App\Models\Meeting;
                $meeting = \App\Models\Meeting::where('patient_id', auth()->user()->id)
                                  ->where('appointment_id', $appointment->id)
                                  ->latest()
                                  ->first();
            @endphp
                <tr>
                    <td>{{ $appointment->patient->name }}</td>
                    <td>{{ $appointment->doctor->name }}</td>
                    <td>{{ $appointment->appointment_date }}</td>
                    <td>{{ $appointment->appointment_time }}</td>
                    
                    <td>
                        @if ($meeting && $meeting->start_url)
                        
                        <a href="{{ $meeting->start_url }}">Join now</a>
                        @else

                         No scheduled Zoom meeting found.

                        @endif
                    </td>

                    <td>
                        @php
                            // Fetch the prescription associated with the appointment
                            $prescription = \App\Models\Doctor\Prescription::where('appointment_id', $appointment->id)->first();
                        @endphp

                        @if($prescription)
                            <a class="btn btn-success" href="{{ route('prescriptions.download', [
                                'id' => $prescription->id
        
                            ]) }}">Download Prescription</a>
                        @else

                        @endif
                    </td>

                    <td>{{ ucfirst($appointment->status) }}</td>
                    <td>
                        <!-- Form for editing the appointment, directly in the loop -->
                        <form action="{{ route('patient.appointments.update', $appointment->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')

                            <!-- Appointment Date -->
                            <div class="mb-3">
                                <label for="appointment_date_{{ $appointment->id }}" class="form-label">Appointment Date</label>
                                <input type="date" id="appointment_date_{{ $appointment->id }}" name="appointment_date" class="form-control" value="{{ $appointment->appointment_date }}">
                            </div>

                            <!-- Appointment Time -->
                            <div class="mb-3">
                                <label for="appointment_time_{{ $appointment->id }}" class="form-label">Appointment Time</label>
                                <input type="time" id="appointment_time_{{ $appointment->id }}" name="appointment_time" class="form-control" value="{{ $appointment->appointment_time }}">
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-success btn-sm">Update Appointment</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
   </div>
</div>

@endsection

