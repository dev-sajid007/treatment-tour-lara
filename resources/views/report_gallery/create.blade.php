@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">Add Medical Report</h3>

    <form action="{{ route('report_galleries.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Report Image</label>
            <input type="file" name="report_image" class="form-control" required>
        </div>


        <button class="btn btn-success">Submit</button>
        <a href="{{ route('report_galleries.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
