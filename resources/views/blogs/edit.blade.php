@extends('layouts.admin')

@section('content')

<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>

<div class="container-fluid">
    <h2>Edit Blog Post</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Title -->
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $blog->title) }}" required>
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Content -->
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea name="content" id="details" class="form-control" rows="5" required>{{ old('content', $blog->description) }}</textarea>
            @error('content')
                <div class="text-danger">{{ $message }}</div>
            @enderror
          
        </div>

        <!-- Current Image -->
        @if($blog->image && $blog->image !== 'uploads/blog/no.png')
            <div class="mb-3">
                <label class="form-label">Current Image</label><br>
                <img src="{{ asset($blog->image) }}" alt="Current Image" width="150">
            </div>
        @endif

        <!-- New Image -->
        <div class="mb-3">
            <label for="image" class="form-label">Change Image (optional)</label>
            <input type="file" name="image" class="form-control">
            @error('image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit -->
        <button type="submit" class="btn btn-success">Update Blog</button>
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
