@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">Edit Medical Report</h3>

    <form action="{{ route('report_galleries.update', $medicalReport->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" value="{{ $medicalReport->title }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Current Image</label><br>
            <img src="{{ asset($medicalReport->report_image) }}" width="100" alt="Report Image">
        </div>

        <div class="mb-3">
            <label class="form-label">New Report Image (optional)</label>
            <input type="file" name="report_image" class="form-control">
        </div>


        <button class="btn btn-primary">Update</button>
        <a href="{{ route('report_galleries.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
