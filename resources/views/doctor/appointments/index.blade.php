@extends('layouts.admin')

@section('content')
<div class="container-fluid">
   <div class="card border-0 p-4">
    <h2>Patient Appointments</h2>

    <!-- Table displaying the appointments -->
    <div class="table-responsive">
    <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Patient Name</th>
                <th>Doctor Name</th>
                <th>Appointment Date</th>
                <th>Appointment Time</th>
                <th>Status</th>
                <th>Action</th>
                <td>Prescription</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($appointments as $appointment)
                <tr>
                    <td>{{ $appointment->patient->name }}</td>
                    <td>{{ $appointment->doctor->name }}</td>
                    <td>{{ $appointment->appointment_date }}</td>
                    <td>{{ $appointment->appointment_time }}</td>
                    <td>{{ ucfirst($appointment->status) }}</td>
                    
                    <td>
                        <!-- Form for editing the appointment, directly in the loop -->
                        <form action="{{ route('doctor.appointments.update', $appointment->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')

                            <!-- Appointment Date -->

                            <!-- Appointment Time -->
                            <div class="mb-3">
                                <label for="status_{{ $appointment->id }}" class="form-label">Status</label>
                                <select name="status" class="form-control">
                                <option value="scheduled" {{ $appointment->status == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                                <option value="completed" {{ $appointment->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="canceled" {{ $appointment->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                                <option value="approved" {{ $appointment->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                </select>

                
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-success btn-sm">Update Appointment</button>
                        </form>
                    </td>

                    <td>
                            @php
                                // Fetch the prescription associated with the appointment
                                $prescription = \App\Models\Doctor\Prescription::where('appointment_id', $appointment->id)->first();
                            @endphp

                            @if($prescription)
                                <a class="btn btn-success" href="{{ route('prescriptions.edit', [
                                    'prescription' => $prescription->id,
                                    'appointment' => $appointment->id, 
                                    'doctor' => $appointment->doctor->id, 
                                    'patient' => $appointment->patient->id
                                ]) }}">edit</a>
                            @else
                                <a class="btn btn-success" href="{{ route('prescriptions.create', [
                                    'appointment' => $appointment->id, 
                                    'doctor' => $appointment->doctor->id, 
                                    'patient' => $appointment->patient->id
                                ]) }}">Create Prescription</a>
                            @endif
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
</div>

   </div>
</div>

@endsection

