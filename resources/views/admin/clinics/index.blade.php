@extends('layouts.admin')
    @section('title', 'Clinics')
    @section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4>All Clinics</h4>
                        </div>
                        <a href="{{ route('admin.clinics.create') }}" class="btn btn-primary">Add Clinic</a>
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
                                        <th>Categories</th>
                                        <th>Subcategories</th>
                                        <th>Specialities</th>
                                        <th>Main Image</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($clinics as $clinic)
                                        <tr>
                                            <td>{{ $clinic->id }}</td>
                                            <td>{{ $clinic->name }}</td>
                                            <td>{{ $clinic->country->name ?? ''}}</td>
                                            <td>{{ $clinic->state->name  ?? ''}}</td>
                                            <td>
                                                @foreach($clinic->categories as $category)
                                                    {{ $category->name }},
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach($clinic->subcategories as $subcategory)
                                                    {{ $subcategory->name }},
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach($clinic->specialities as $speciality)
                                                    {{ $speciality->name }},
                                                @endforeach
                                            </td>
                                            <td>
                                                @if($clinic->main_image)
                                                    <img src="{{ asset('storage/img/' . $clinic->main_image) }}" width="80" alt="Clinic Main Image">
                                                @else
                                                    No image
                                                @endif
                                            </td>
                                            <td>
                                                <!-- Add Quote -->
                                                <a href="{{ route('admin.quote.index', $clinic->id) }}" class="btn btn-success btn-sm">Add Quote</a>
                                                <!-- Add Doctors -->
                                                <a href="{{ route('admin.doctors.index', $clinic->id) }}" class="btn btn-success btn-sm">Add Doctors</a>
                                                 <!-- Add Portfolio -->
                                                <a href="{{ route('admin.portfolios.index', $clinic->id) }}" class="btn btn-success btn-sm">Add Portfolio</a>
                                                <!-- Show Clinic -->
                                                <a href="{{ route('admin.clinics.show', $clinic->id) }}" class="btn btn-info btn-sm">View</a>

                                                <!-- Edit Clinic -->
                                                <a href="{{ route('admin.clinics.edit', $clinic->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                                <!-- Delete Clinic -->
                                                <form action="{{ route('admin.clinics.destroy', $clinic->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this clinic?');">Delete</button>
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
