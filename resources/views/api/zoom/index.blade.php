@extends('layouts.admin')

@section('content')
<div class="container-fluid">
   <div class="card border-0 p-4">
              <h2 class="mb-4">Zoom Meetings</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Meeting Creation Form -->
    <form action="{{ route('zoom.create') }}" method="POST" class="mb-4">
        @csrf
        <div class="mb-3">
            <label class="form-label">Meeting Topic:</label>
            <input type="text" name="topic" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Start Time:</label>
            <input type="datetime-local" name="start_time" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Duration (minutes):</label>
            <input type="number" name="duration" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Password (Optional):</label>
            <input type="text" name="password" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Create Meeting</button>
    </form>

    <!-- List of Meetings -->
    <h3>Scheduled Meetings</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Topic</th>
                <th>Start Time</th>
                <th>Duration</th>
                <th>Start Link</th>
                <th>Join Link</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>{{--
            @forelse($meetings['meetings'] ?? [] as $meeting)
                <tr>
                    <td>{{ $meeting['topic'] }}</td>
                    <td>{{ \Carbon\Carbon::parse($meeting['start_time'])->format('Y-m-d H:i') }}</td>
                    <td>{{ $meeting['duration'] }} mins</td>
                    <td><a href="{{ $meeting['join_url'] }}" target="_blank">Join</a></td>
                    <td>
                        <form action="{{ route('zoom.delete', $meeting['id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5">No meetings scheduled.</td></tr>
            @endforelse
            --}}

            @forelse($meetings as $meeting)
                <tr>
                    <td>{{ $meeting['topic'] }}</td>
                    <td>{{ \Carbon\Carbon::parse($meeting['start_time'])->format('Y-m-d H:i') }}</td>
                    <td>{{ $meeting['duration'] }} mins</td>
                    <td><a href="{{ $meeting['start_url'] }}" target="_blank">Join</a></td>
                    <td><a href="{{ $meeting['join_url'] }}" target="_blank">Join</a></td>
                    <td>
                        <form action="{{ route('zoom.delete', $meeting['id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5">No meetings scheduled.</td></tr>
            @endforelse
        </tbody>
    </table>

   </div>
</div>

@endsection

