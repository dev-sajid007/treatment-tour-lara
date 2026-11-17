@extends('layouts.admin')

@section('content')

<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
<div class="container-fluid py-5">
    <h1 class="mb-4 h4">Create Page Generation</h1>

    <form action="{{ route('page_generations.store') }}" method="POST" class="card p-4 shadow-sm">
        @csrf

        <!-- Placement Field -->
        <div class="mb-3">
            <label for="placement" class="form-label">Placement</label>
            <select name="placement" id="placement" class="form-select">
                <option value="">-- Select Placement --</option>
                <option value="header" {{ old('placement') == 'header' ? 'selected' : '' }}>Header</option>
                <option value="footer" {{ old('placement') == 'footer' ? 'selected' : '' }}>Footer</option>
            </select>
            @error('placement')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Slug Field -->
        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" name="slug" id="slug" value="{{ old('slug') }}" class="form-control">
            @error('slug')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Page Name Field -->
        <div class="mb-3">
            <label for="page_name" class="form-label">Page Name</label>
            <input type="text" name="page_name" id="page_name" value="{{ old('page_name') }}" class="form-control">
            @error('page_name')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Title Field -->
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control">
            @error('title')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Description Field -->
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" rows="5" class="form-control">{{ old('description') }}</textarea>
            @error('description')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</div>
<script>
        // Initialize CKEditor with upload functionality
        ClassicEditor
            .create(document.querySelector('#description'), {
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
