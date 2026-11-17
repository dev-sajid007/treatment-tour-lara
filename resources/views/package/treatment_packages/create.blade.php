@extends('layouts.admin')

@section('content')

   <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
<div class="container-fluid">
   <div class="card border-0 p-4">
        <h2>Add New Treatment Packages</h2>

         <form action="{{ route('treatment-packages.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group mb-2">
                <label for="package_name">Package Name</label>
                <input type="text" name="package_name" id="package_name" class="form-control" required>
            </div>

            <div class="form-group mb-2">
                <label for="treatment_category_id">Category</label>
                <select name="treatment_category_id" id="treatment_category_id" class="form-control" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-2">
                <label for="country_id">Country</label>
                <select name="country_id" id="country_id" class="form-control" required>
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-2">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>

            <div class="form-group mb-2">
                <label for="price">Price</label>
                <input type="number" name="price" id="price" class="form-control" required>
            </div>

            <div class="form-group mb-2">
                <label for="status">Status</label>
                <select name="status" class="form-control">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

            <div class="form-group mb-2">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>

            <button type="submit" class="btn btn-success">Create Package</button>
        </form>
        
    </div>
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

