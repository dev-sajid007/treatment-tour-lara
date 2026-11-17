@extends('layouts.admin')
    @section('title', 'Featured On Platforms')
    @section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10 mx-auto">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Featured On Platforms</h4>
                        </div>
                        <!-- Button trigger modal for Add FeaturedOn -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#featuredOnModal">
                            Add Platform
                        </button>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                        <div class="alert text-white bg-success" role="alert">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="iq-success-text">{{ session('success') }}</div>
                                <button type="button" class="close btn btn-danger ms-4" aria-label="Close" onclick="closeAlert(this)">
                                    X
                                </button>
                            </div>
                        </div>
                        @endif

                        @if ($errors->any())
                        <div class="alert text-white bg-danger" role="alert">
                            @foreach ($errors->all() as $error)
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="iq-alert-text">{{ $error }}</div>
                                <button type="button" data-dismiss="alert" class="close btn btn-danger ms-4" aria-label="Close" onclick="closeAlert(this)">
                                    X
                                </button>
                            </div>
                            @endforeach
                        </div>
                        @endif

                        <!-- FeaturedOn Table -->
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($featuredOns as $featuredOn)
                                    <tr>
                                        <td>{{ $featuredOn->id }}</td>
                                        <td>{{ $featuredOn->name }}</td>
                                        <td>
                                            @if($featuredOn->image)
                                                <img src="{{ asset('storage/img/' . $featuredOn->image) }}" width="100" />
                                            @endif
                                        </td>
                                        <td>
                                            <!-- Edit Button -->
                                            <button class="btn btn-warning btn-sm" onclick="openEditModal({{ $featuredOn }})">Edit</button>

                                            <!-- Delete Button -->
                                            <button class="btn btn-danger btn-sm" onclick="confirmDelete({{ $featuredOn->id }})">Delete</button>

                                            <!-- Delete Form -->
                                            <form id="deleteForm{{ $featuredOn->id }}" action="{{ route('admin.featured_on.destroy', $featuredOn->id) }}" method="POST" style="display: none;">
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

    <!-- Add/Edit FeaturedOn Modal -->
    <div class="modal fade" id="featuredOnModal" tabindex="-1" aria-labelledby="featuredOnModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="featuredOnModalLabel">Add Platform</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="featuredOnForm" action="{{ route('admin.featured_on.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Spoof method for updating -->
                    <div id="methodField"></div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Platform Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image" name="image">
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

    <!-- Script for Handling Modal -->
    <script>
        // Clear form for adding new FeaturedOn
        document.querySelector('[data-bs-target="#featuredOnModal"]').addEventListener('click', function () {
            document.getElementById('featuredOnForm').action = '{{ route("admin.featured_on.store") }}';
            document.getElementById('methodField').innerHTML = '';
            document.getElementById('featuredOnModalLabel').innerText = 'Add Platform';
            document.getElementById('name').value = '';
            document.getElementById('image').value = '';
        });

        // Open Edit Modal
        function openEditModal(featuredOn) {
            document.getElementById('featuredOnForm').action = `/admin/featured_on/${featuredOn.id}`;
            document.getElementById('methodField').innerHTML = '<input type="hidden" name="_method" value="PUT">';
            document.getElementById('featuredOnModalLabel').innerText = 'Edit Platform';
            document.getElementById('name').value = featuredOn.name;
            var modal = new bootstrap.Modal(document.getElementById('featuredOnModal'));
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
        function closeAlert(button) {
            button.parentElement.parentElement.remove();
        }
    </script>

@endsection
