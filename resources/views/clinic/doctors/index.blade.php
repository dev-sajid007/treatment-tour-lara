@extends('layouts.admin')
    @section('title', 'Doctors for Clinic: ' . $clinic->name)
    @section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10 mx-auto">
                <div class="card mb-4">
                    <div class="card-header">
                        <button class="btn btn-primary float-right" data-bs-toggle="modal" data-bs-target="#addDoctorModal">Add Doctor</button>
                    </div>

                    <!-- Doctors Table -->
                    <div class="card-body">
                        @if($doctors->isEmpty())
                            <p>No doctors added yet.</p>
                        @else
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Experience Years</th>
                                        <th>Spoken Languages</th>
                                        <th>Image</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($doctors as $doctor)
                                        <tr>
                                            <td>{{ $doctor->id }}</td>
                                            <td>{{ $doctor->name }}</td>
                                            <td>{{ $doctor->email }}</td>
                                            <td>{{ $doctor->experience_years }} years</td>
                                            <td>{{ $doctor->spoken_languages }}</td>
                                            <td>
                                                @if($doctor->image)
                                                    <img src="{{ asset('storage/doctors/' . $doctor->image) }}" width="100" />
                                                @else
                                                    <p>No image available</p>
                                                @endif
                                            </td>
                                            <td>
                                                <!-- Edit Doctor Button -->
                                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editDoctorModal{{ $doctor->id }}">Edit</button>

                                                <!-- Delete Doctor -->
                                                <form action="{{ route('clinics.doctors.destroy', $doctor->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this doctor?');">Delete</button>
                                                </form>
                                            </td>
                                        </tr>

                                        <!-- Edit Doctor Modal -->
                                        <div class="modal fade" id="editDoctorModal{{ $doctor->id }}" tabindex="-1" aria-labelledby="editDoctorModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editDoctorModalLabel">Edit Doctor</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('clinics.doctors.update', $doctor->id) }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <label for="name" class="form-label">Doctor Name</label>
                                                                <input type="text" class="form-control" id="name" name="name" value="{{ $doctor->name }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="email" class="form-label">Doctor Email</label>
                                                                <input type="email" class="form-control" id="email" name="email" value="{{ $doctor->email }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="experience_years" class="form-label">Experience Years</label>
                                                                <input type="number" class="form-control" id="experience_years" name="experience_years" value="{{ $doctor->experience_years }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="spoken_languages" class="form-label">Spoken Languages</label>
                                                                <input type="text" class="form-control" id="spoken_languages" name="spoken_languages" value="{{ $doctor->spoken_languages }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="associations" class="form-label">Associations</label>
                                                                <textarea class="form-control" id="associations" name="associations">{{ $doctor->associations }}</textarea>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="education" class="form-label">Education</label>
                                                                <textarea class="form-control" id="education" name="education">{{ $doctor->education }}</textarea>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="image" class="form-label">Doctor Image</label>
                                                                <input type="file" class="form-control" id="image" name="image">
                                                                @if($doctor->image)
                                                                    <img src="{{ asset('storage/doctors/' . $doctor->image) }}" width="100" />
                                                                @endif
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
                        @endif
                    </div>
                </div>

                <!-- Add Doctor Modal -->
                <div class="modal fade" id="addDoctorModal" tabindex="-1" aria-labelledby="addDoctorModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addDoctorModalLabel">Add Doctor</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('clinics.doctors.store', $clinic->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Doctor Name</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Doctor Email</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="experience_years" class="form-label">Experience Years</label>
                                        <input type="number" class="form-control" id="experience_years" name="experience_years" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="spoken_languages" class="form-label">Spoken Languages</label>
                                        <input type="text" class="form-control" id="spoken_languages" name="spoken_languages" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="associations" class="form-label">Associations</label>
                                        <textarea class="form-control" id="associations" name="associations"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="education" class="form-label">Education</label>
                                        <textarea class="form-control" id="education" name="education"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Doctor Image</label>
                                        <input type="file" class="form-control" id="image" name="image">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Add Doctor</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
