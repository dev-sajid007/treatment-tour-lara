@extends('layouts.admin')
@section('title', 'Hospitals')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h4>Hospital Pending Requests</h4>
                    </div>
                    <a href="{{ route('admin.hospitals.create') }}" class="btn btn-primary">Add Hospital</a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Country</th>
                                    <th>State</th>
                                    <th>Image</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($hospitals as $hospital)
                                    <tr>
                                        <td>{{ $hospital->id }}</td>
                                        <td>{{ $hospital->name }}</td>
                                        <td>{{ $hospital->country->name ?? '' }}</td>
                                        <td>{{ $hospital->state_city->name ?? '' }}</td>
                                        <td>
                                            @if($hospital->image)
                                                <img src="{{ asset('storage/images/hospitals/' . $hospital->image) }}" width="80" alt="Hospital Image">
                                            @else
                                                No image
                                            @endif
                                        </td>
                                        <td>
                                            <!-- Show Hospital -->
                                            <a href="{{ route('admin.hospitals.show', $hospital->id) }}" class="btn btn-info btn-sm">View</a>

                                            <!-- Edit Hospital -->
                                            <a href="{{ route('admin.hospitals.edit', $hospital->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                            <!-- Approve Button -->
                                            <form action="{{ route('admin.hospitals.approve', $hospital->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('POST')
                                                <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                            </form>

                                            <!-- Cancel Button -->
                                            <form action="{{ route('admin.hospitals.cancel', $hospital->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('POST')
                                                <button type="submit" class="btn btn-danger btn-sm">Cancel</button>
                                            </form>

                                            <!-- Delete Hospital -->
                                            <form action="{{ route('admin.hospitals.destroy', $hospital->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-dark btn-sm" onclick="return confirm('Are you sure you want to delete this hospital?');">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
