@extends('layouts.admin')
    <!-- Wrapper Start -->
    @section('title', 'Categories')
    @section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10 mx-auto">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h3>Categories</h3>
                        </div>
                        <!-- Button trigger modal for Add Category -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#categoryModal">
                            Add Category
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

                        <!-- Category Table -->
                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Details</th>
                                        <th>Image</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->details }}</td>
                                        <td><img src="{{ asset('storage/img/' . $category->image) }}" width="50" /></td>
                                        <td>
                                            <!-- Edit Button -->
                                            <button class="btn btn-warning btn-sm" onclick="openEditModal({{ $category }})">Edit</button>

                                            <!-- Delete Button -->
                                            <button class="btn btn-danger btn-sm" onclick="confirmDelete({{ $category->id }})">Delete</button>

                                            <!-- Delete Form -->
                                            <form id="deleteForm{{ $category->id }}" action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display: none;">
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

    <!-- Add/Edit Category Modal -->
    <div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryModalLabel">Add/Edit Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="categoryForm" action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="categoryId" name="category_id" value="">
                    
                    <!-- Add this line for method spoofing when editing -->
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
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                        <div class="mb-3">
                                <label for="type" class="form-label">Category Type</label>
                                <select class="form-select" id="type" name="type">
                                    <option value="medical" selected>Medical</option>
                                    <option value="cosmetic">Cosmetic</option>
                                </select>
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


    <!-- Script to handle Modals and Delete Confirmation -->
    <script>
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

        function openEditModal(category) {
            // Set form action for updating the category
            document.getElementById('categoryForm').action = `/categories/${category.id}`;
            
            // Spoof the PUT method for editing
            document.getElementById('methodField').innerHTML = '<input type="hidden" name="_method" value="PUT">';

            // Populate form fields with category data
            document.getElementById('categoryId').value = category.id;
            document.getElementById('name').value = category.name;
            document.getElementById('details').value = category.details;

            // Change the modal title
            document.getElementById('categoryModalLabel').innerText = 'Edit Category';

            // Show the modal
            var modal = new bootstrap.Modal(document.getElementById('categoryModal'));
            modal.show();
        }

        // Clear the form for adding a new category
        document.querySelector('[data-bs-target="#categoryModal"]').addEventListener('click', function () {
            document.getElementById('categoryForm').action = '{{ route("categories.store") }}';
            
            // Remove the method spoofing input
            document.getElementById('methodField').innerHTML = '';

            // Clear form fields
            document.getElementById('categoryId').value = '';
            document.getElementById('name').value = '';
            document.getElementById('details').value = '';

            // Change the modal title
            document.getElementById('categoryModalLabel').innerText = 'Add Category';
        });

    </script>

@endsection
