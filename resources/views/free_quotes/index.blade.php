@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Free Quotes</h2>
      
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive shadow-sm rounded">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Destination</th>
                    <th>Treatment</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($quotes as $quote)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $quote->name }}</td>
                    <td>{{ $quote->email }}</td>
                    <td>{{ $quote->phone }}</td>
                    <td>{{ $quote->destination }}</td>
                    <td>{{ $quote->treatment }}</td>
                    <td>
                        
                        <form action="{{ route('free-quotes.destroy', $quote->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this quote?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">No quotes found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>


</div>
@endsection
