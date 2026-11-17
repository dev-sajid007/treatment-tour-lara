@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class=""></div>
    <h2>My Visiting Hour</h2>


    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Doctor</th>
                <th>Day of Week</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Max Patients</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($doctorSlots as $slot)
                <tr>
                    <td>{{ $slot->id }}</td>
                    <td>{{ $slot->doctor->name }}</td>
                    <td>{{ $slot->day_of_week }}</td>
                    <td>{{ (new DateTime($slot->start_time))->format('h:i A') }}</td>
                    <td>{{ (new DateTime($slot->end_time))->format('h:i A') }}</td>


                    <td>{{ $slot->max_patients }}</td>
                    <td>{{ ucfirst($slot->status) }}</td>
                    <td>
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $slot->id }}">Edit</button>

                        <form action="{{ route('slots.destroy', $slot->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>

                {{-- Edit Modal --}}
                <div class="modal fade" id="editModal{{ $slot->id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Edit Doctor Slot</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('slots.update', $slot->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3">
                                        <label for="day_of_week" class="form-label">Day of Week</label>
                                        <select name="day_of_week" id="day_of_week" class="form-select">
                                            <option value="Monday" {{ $slot->day_of_week == 'Monday' ? 'selected' : '' }}>Monday</option>
                                            <option value="Tuesday" {{ $slot->day_of_week == 'Tuesday' ? 'selected' : '' }}>Tuesday</option>
                                            <option value="Wednesday" {{ $slot->day_of_week == 'Wednesday' ? 'selected' : '' }}>Wednesday</option>
                                            <option value="Thursday" {{ $slot->day_of_week == 'Thursday' ? 'selected' : '' }}>Thursday</option>
                                            <option value="Friday" {{ $slot->day_of_week == 'Friday' ? 'selected' : '' }}>Friday</option>
                                            <option value="Saturday" {{ $slot->day_of_week == 'Saturday' ? 'selected' : '' }}>Saturday</option>
                                            <option value="Sunday" {{ $slot->day_of_week == 'Sunday' ? 'selected' : '' }}>Sunday</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="start_time" class="form-label">Start Time</label>
                                        <input type="time" name="start_time" id="start_time" class="form-control" value="{{ $slot->start_time }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="end_time" class="form-label">End Time</label>
                                        <input type="time" name="end_time" id="end_time" class="form-control" value="{{ $slot->end_time }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="max_patients" class="form-label">Max Patients</label>
                                        <input type="number" name="max_patients" id="max_patients" class="form-control" value="{{ $slot->max_patients }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select name="status"  class="form-control">
                                            <option value="active" {{ $slot->status == 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="inactive" {{ $slot->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
</div>
@endsection