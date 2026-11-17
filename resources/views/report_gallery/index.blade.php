@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Medical Reports</h3>
        <a href="{{ route('report_galleries.create') }}" class="btn btn-primary">+ Add Report</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($reports as $report)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $report->title }}</td>
                    <td><img src="{{ asset($report->report_image) }}" width="60" alt="Report Image"></td>
                    <td>
                        <a href="{{ route('report_galleries.edit', $report->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('report_galleries.destroy', $report->id) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Are you sure you want to delete this report?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5">No reports found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
