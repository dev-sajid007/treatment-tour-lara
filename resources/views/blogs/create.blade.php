@extends('layouts.admin')
@section('content')
@section('title', 'Blog Create')

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="container-fluid p-4">
    <div class="content">

        <h2 class="text-center mb-4">Create New Blog</h2>

        <div class="card shadow-sm p-4">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Title -->
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" 
                           class="form-control" 
                           placeholder="Enter Blog Title" required>
                </div>

                <!-- Image Upload -->
                <div class="mb-3">
                    <label class="form-label">Image</label>
                    <input type="file" name="image" accept="image/*" 
                           class="form-control">
                </div>

                <!-- Content -->
                <div class="mb-3">
                    <label class="form-label">Content</label>
                    <textarea name="content" id="content" rows="5" 
                              class="form-control"
                              placeholder="Enter Full Content"></textarea>
                </div>

                <!-- Submit Button -->
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Save Blog</button>
                    <a href="{{ route('blogs.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
<script>
    // Initialize CKEditor with upload functionality
    ClassicEditor
        .create(document.querySelector('#content'), {
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

