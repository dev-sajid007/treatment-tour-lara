@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="card border-0 p-4">
    <h2>Add My Visiting Hour</h2>

    <form action="{{ route('slots.store') }}" method="POST">
        @csrf


        <div class="mb-3">
            <label for="day_of_week" class="form-label">Day of Week</label>
            <select name="day_of_week" id="day_of_week" class="form-select">
                <option value="Monday">Monday</option>
                <option value="Tuesday">Tuesday</option>
                <option value="Wednesday">Wednesday</option>
                <option value="Thursday">Thursday</option>
                <option value="Friday">Friday</option>
                <option value="Saturday">Saturday</option>
                <option value="Sunday">Sunday</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="start_time" class="form-label">Start Time</label>
            <input type="time" name="start_time" id="start_time" class="form-control">
        </div>

        <div class="mb-3">
            <label for="end_time" class="form-label">End Time</label>
            <input type="time" name="end_time" id="end_time" class="form-control">
        </div>

        <div class="mb-3">
            <label for="max_patients" class="form-label">Max Patients</label>
            <input type="number" name="max_patients" id="max_patients" class="form-control">
        </div>

        <div class="mb-5">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-control">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
   </div>
</div>
@endsection