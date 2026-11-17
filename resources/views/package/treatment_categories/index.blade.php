@extends('layouts.admin')

@section('content')
<div class="container-fluid">
   <div class="card border-0 p-4">
        <h2>All Treatment Categories</h2>
    
        <!-- Button to trigger Create Category Modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createCategoryModal">
            Add New Category
        </button>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Category Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $category->category_name }}</td>
                    <td>{{ $category->description }}</td>
                    <td>
                        <!-- Edit Button (Opens Unique Modal) -->
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editCategoryModal{{ $category->id }}">
                            Edit
                        </button>

                        <!-- Delete Form -->
                        <form action="{{ route('treatment-categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>

                <!-- Unique Edit Category Modal -->
                <div class="modal fade" id="editCategoryModal{{ $category->id }}" tabindex="-1" aria-labelledby="editCategoryModalLabel{{ $category->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editCategoryModalLabel{{ $category->id }}">Edit Treatment Category</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('treatment-categories.update', $category->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="category_id" value="{{ $category->id }}">
                                    <div class="mb-3">
                                        <label for="edit_category_name{{ $category->id }}" class="form-label">Category Name</label>
                                        <input type="text" class="form-control" name="category_name" id="edit_category_name{{ $category->id }}" value="{{ $category->category_name }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="edit_description{{ $category->id }}" class="form-label">Description</label>
                                        <textarea class="form-control" name="description" id="edit_description{{ $category->id }}">{{ $category->description }}</textarea>
                                    </div>
                                    <button type="submit" class="btn btn-success">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>

    </div>

    <!-- Create Category Modal -->
    <div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createCategoryModalLabel">Add Treatment Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('treatment-categories.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="category_name" class="form-label">Category Name</label>
                            <input type="text" class="form-control" name="category_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" name="description"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

