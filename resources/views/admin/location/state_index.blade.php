@extends('layouts.admin')
    @section('title', 'States')
    @section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10 mx-auto">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h3>States</h3>
                        </div>
                        <!-- Button trigger modal for Add State -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#stateModal">
                            Add State
                        </button>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <!-- States Table -->
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>State Name</th>
                                        <th>Country</th>
                                        <th>Details</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($states as $state)
                                    <tr>
                                        <td>{{ $state->id }}</td>
                                        <td>{{ $state->name }}</td>
                                        <td>{{ $state->country->name ?? '' }}</td>
                                        <td>{{ $state->details }}</td>
                                        <td>
                                            <!-- Edit Button -->
                                            <button class="btn btn-warning btn-sm" onclick="openEditStateModal({{ $state }})">Edit</button>

                                            <!-- Delete Button -->
                                            <button class="btn btn-danger btn-sm" onclick="confirmDeleteState({{ $state->id }})">Delete</button>

                                            <!-- Delete Form -->
                                            <form id="deleteFormState{{ $state->id }}" action="{{ route('admin.location.deletestate', $state->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
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

    <!-- Add/Edit State Modal -->
    <div class="modal fade" id="stateModal" tabindex="-1" aria-labelledby="stateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="stateModalLabel">Add State</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="stateForm" action="{{ route('admin.location.storestate') }}" method="POST">
                    @csrf
                    <!-- Spoof method for updating -->
                    <div id="methodField"></div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="country_id" class="form-label">Select Country</label>
                            <select class="form-control" id="country_id" name="country_id" required>
                                <option value="">Select a country</option>
                                @foreach($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">State Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="details" class="form-label">Details</label>
                            <textarea class="form-control" id="details" name="details"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Clear form for adding new State
        document.querySelector('[data-bs-target="#stateModal"]').addEventListener('click', function () {
            document.getElementById('stateForm').action = '{{ route("admin.location.storestate") }}';
            document.getElementById('methodField').innerHTML = '';
            document.getElementById('stateModalLabel').innerText = 'Add State';
            document.getElementById('country_id').value = '';
            document.getElementById('name').value = '';
            document.getElementById('details').value = '';
        });

        // Open Edit Modal
        function openEditStateModal(state) {
            document.getElementById('stateForm').action = `/admin/location/state/${state.id}`;
            document.getElementById('methodField').innerHTML = '<input type="hidden" name="_method" value="PUT">';
            document.getElementById('stateModalLabel').innerText = 'Edit State';
            document.getElementById('country_id').value = state.country_id;
            document.getElementById('name').value = state.name;
            document.getElementById('details').value = state.details;
            var modal = new bootstrap.Modal(document.getElementById('stateModal'));
            modal.show();
        }

        // Confirm Delete
        function confirmDeleteState(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteFormState' + id).submit();
                }
            });
        }
    </script>

@endsection
