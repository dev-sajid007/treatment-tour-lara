@extends('layouts.admin')
    @section('title', 'Countries')
    @section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10 mx-auto">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h3>Countries</h3>
                        </div>
                        <!-- Button trigger modal for Add Country -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#countryModal">
                            Add Country
                        </button>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <!-- Countries Table -->
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Details</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($countries as $country)
                                    <tr>
                                        <td>{{ $country->id }}</td>
                                        <td>{{ $country->name }}</td>
                                        <td>{{ $country->details }}</td>
                                        <td>
                                            <!-- Edit Button -->
                                            <button class="btn btn-warning btn-sm" onclick="openEditModal({{ $country }})">Edit</button>

                                            <!-- Delete Button -->
                                            <button class="btn btn-danger btn-sm" onclick="confirmDelete({{ $country->id }})">Delete</button>

                                            <!-- Delete Form -->
                                            <form id="deleteForm{{ $country->id }}" action="{{ route('admin.location.destroy', $country->id) }}" method="POST" style="display: none;">
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

    <!-- Add/Edit Country Modal -->
    <div class="modal fade" id="countryModal" tabindex="-1" aria-labelledby="countryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="countryModalLabel">Add Country</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="countryForm" action="{{ route('admin.location.store') }}" method="POST">
                    @csrf
                    <!-- Spoof method for updating -->
                    <div id="methodField"></div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
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

    <!-- Scripts -->
    <script>
        // Clear form for adding new country
        document.querySelector('[data-bs-target="#countryModal"]').addEventListener('click', function () {
            document.getElementById('countryForm').action = '{{ route("admin.location.store") }}';
            document.getElementById('methodField').innerHTML = '';
            document.getElementById('countryModalLabel').innerText = 'Add Country';
            document.getElementById('name').value = '';
            document.getElementById('details').value = '';
        });

        // Open Edit Modal
        function openEditModal(country) {
            document.getElementById('countryForm').action = `/admin/location/${country.id}`;
            document.getElementById('methodField').innerHTML = '<input type="hidden" name="_method" value="PUT">';
            document.getElementById('countryModalLabel').innerText = 'Edit Country';
            document.getElementById('name').value = country.name;
            document.getElementById('details').value = country.details;
            var modal = new bootstrap.Modal(document.getElementById('countryModal'));
            modal.show();
        }

        // Confirm Delete
        function confirmDelete(id) {
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
                    document.getElementById('deleteForm' + id).submit();
                }
            });
        }
    </script>

@endsection
