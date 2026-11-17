@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Podcast List</h4>
        <a href="{{ route('podcasts.create') }}" class="btn btn-primary">Add New Podcast</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Video Link</th>
                <th style="width: 180px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($podcasts as $index => $podcast)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $podcast->video }}</td>
                <td>
                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $podcast->id }}">
                        Edit
                    </button>
                    <form action="{{ route('podcasts.destroy', $podcast->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Delete this podcast?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>

            <!-- Edit Modal -->
            <div class="modal fade" id="editModal{{ $podcast->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $podcast->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('podcasts.update', $podcast->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Podcast</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label class="form-label">Video Link</label>
                                    <input type="text" name="video" class="form-control" value="{{ $podcast->video }}" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
