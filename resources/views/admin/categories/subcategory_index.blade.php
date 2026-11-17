@extends('layouts.admin')
@section('title', 'SubCategories')
@section('content')


<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 mx-auto">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h3>SubCategories</h3>
                    </div>
                    <!-- Button trigger modal for Add SubCategory -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createSubcategoryModal">
                        Add SubCategory
                    </button>
                </div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <!-- SubCategory Table -->
                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>SubCategory Name</th>
                                    <th>Parent Category</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($subcategories as $subcategory)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $subcategory->name }}</td>
                                    <td>{{ $subcategory->category->name ?? '' }}</td>
                                    <td>
                                        <!-- Edit Button -->
                                        <a class="btn btn-warning btn-sm" href="{{route('sub.edit', $subcategory->id)}}">Edit</a>

                                        <!-- Delete Button -->
                                        <button class="btn btn-danger btn-sm" onclick="confirmDelete({{ $subcategory->id }})">Delete</button>

                                        <!-- Delete Form -->
                                        <form id="deleteForm{{ $subcategory->id }}" action="{{ route('deletesubcategory', $subcategory->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>

                                <!-- Modal for Editing -->
                                <div class="modal fade" id="editModal{{ $subcategory->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $subcategory->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $subcategory->id }}">Edit SubCategory</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('updatesubcategory', $subcategory->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="category_id{{ $subcategory->id }}" class="form-label">Select Category</label>
                                                        <select class="form-control" id="category_id{{ $subcategory->id }}" name="category_id" required>
                                                            <option value="">Select a category</option>
                                                            @foreach($categories as $category)
                                                            <option value="{{ $category->id }}" {{ $subcategory->category_id == $category->id ? 'selected' : '' }}>
                                                                {{ $category->name }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="name{{ $subcategory->id }}" class="form-label">SubCategory Name</label>
                                                        <input type="text" class="form-control" id="name{{ $subcategory->id }}" name="name" value="{{ $subcategory->name }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="details{{ $subcategory->id }}" class="form-label">Details</label>
                                                        <textarea class="form-control" id="details{{ $subcategory->id }}" name="details">{{ $subcategory->details }}</textarea>
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal for Adding New SubCategory -->
<div class="modal fade" id="createSubcategoryModal" tabindex="-1" aria-labelledby="createSubcategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createSubcategoryModalLabel">Create SubCategory</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('storesubcategory')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Select Category</label>
                        <select class="form-control" id="category_id" name="category_id" required>
                            <option value="">Select a category</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">SubCategory Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="details" class="form-label">Details</label>
                        <textarea class="form-control" id="details" name="details"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create SubCategory</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
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






