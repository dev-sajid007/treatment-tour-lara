@extends('layouts.admin')
@section('title', 'Categories')
@section('content')

    <!-- CKEditor Script -->
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>

    <div class="container-fluid">
        <!-- Category Form -->
        <form id="categoryForm" action="{{ route('updatesubcategory', $sub->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Name Field -->
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $sub->name }}" required>
            </div>

            <!-- Details Field with CKEditor -->
            <div class="mb-3">
                <label for="details" class="form-label">Details</label>
                <textarea class="form-control" id="details" name="details">{{ $sub->details }}</textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>

    <script>
        // Initialize CKEditor with upload functionality
        ClassicEditor
            .create(document.querySelector('#details'), {
                ckfinder: {
                    // Use the defined route for file uploads
                    uploadUrl: "{{ route('ckeditor.upload') }}?_token={{ csrf_token() }}"
                }
            })
            .then(editor => {
                console.log('Editor initialized', editor);
            })
            .catch(error => {
                console.error('Error initializing editor:', error);
            });
    </script>

@endsection

