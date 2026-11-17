@extends('layouts.admin')

@section('content')

<script src="https://cdn.ckeditor.com/ckeditor5/36.0.0/classic/ckeditor.js"></script>


<div class="container-fluid">
   <div class="card border-0 p-3">
    <h1>Add New Medicine</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('medicines.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Generic Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Trade Name</label>
            <input type="text" class="form-control" id="name" name="trade_name" required>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Dosages</label>
            <input type="number" class="form-control"  name="dosage" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>
        <div class="mb-3">
            <label for="manufacturer" class="form-label">Manufacturer</label>
            <input type="text" class="form-control" id="manufacturer" name="manufacturer">
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select class="form-select" id="category" name="med_category_id">
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add Medicine</button>
    </form>
  </div>
</div>


<script>
    ClassicEditor
        .create(document.querySelector('#description'))
        .catch(error => {
            console.error('CKEditor error:', error);
        });
</script>
@endsection
