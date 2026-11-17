@extends('layouts.admin')
    <!-- Wrapper Start -->
    @section('title', 'Speciality')
    @section('content')

    <div class="container-fluid">
        <div class="card border-0 p-4">

            <h2 class="mb-4">Specialities</h2>

            <!-- Success Message -->
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- Button to trigger Create Modal -->
            <button class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#createModal">Add New Speciality</button>

            <!-- Table of Specialities -->
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Logo</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($specialities as $speciality)
                        <tr>
                            <td>{{ $speciality->name }}</td>
                            <td><img style="width: 80px; height:80px;" src="{{asset($speciality->logo)}}" class="img-fluid" ></td>
                            <td>
                                <!-- Edit Button Trigger -->
                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal" data-id="{{ $speciality->id }}" data-name="{{ $speciality->name }}" data-logo="{{ $speciality->logo }}">Edit</button>

                                <!-- Delete Button -->
                                <form action="{{ route('specialities.destroy', $speciality->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

        <!-- Create Speciality Modal -->
        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Create Speciality</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('specialities.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="logo" class="form-label">Logo</label>
                                <input type="file" class="form-control" id="logo" name="logo" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Speciality</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Speciality Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Speciality</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('specialities.update', 0) }}" method="POST" id="editForm"  enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="edit-name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="edit-name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit-logo" class="form-label">Logo</label>
                                <input type="file" class="form-control" id="edit-logo" name="logo" >
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update Speciality</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            // Set up the Edit Modal with pre-filled data
            var editModal = document.getElementById('editModal');
            editModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var specialityId = button.getAttribute('data-id');
                var specialityName = button.getAttribute('data-name');
                var specialityLogo = button.getAttribute('data-logo');
                
                var form = document.getElementById('editForm');
                form.action = '/specialities/' + specialityId;
                
                document.getElementById('edit-name').value = specialityName;
                document.getElementById('edit-logo').value = specialityLogo;
            });
        </script>




   
@endsection
