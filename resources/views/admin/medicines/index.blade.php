@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="card border-0 p-3">
    <h1>Medicines</h1>
    <a href="{{ route('medicines.create') }}" class="btn btn-primary mb-3">Add New Medicine</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table id="medicines-table" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Generic Name</th>
                <th>Trade Name</th>
                <th>Dosages</th>
                <th>Description</th>
                <th>Manufacturer</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($medicines as $medicine)
                <tr>
                    <td>{{ $medicine->id }}</td>
                    <td>{{ $medicine->name }}</td>
                    <td>{{ $medicine->trade_name }}</td>
                    <td>{{ $medicine->dosage }}</td>
                    <td>{{ \Illuminate\Support\Str::words(strip_tags($medicine->description), 5, '...') }}</td>
                    <td>{{ $medicine->manufacturer }}</td>
                    <td>{{ $medicine->category->name ?? 'N/A' }}</td>
                    <td>
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editMedicineModal{{ $medicine->id }}">Edit</button>
                        <form action="{{ route('medicines.destroy', $medicine->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>

                <!-- Edit Modal -->
                <div class="modal fade" id="editMedicineModal{{ $medicine->id }}" tabindex="-1" aria-labelledby="editMedicineModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editMedicineModalLabel">Edit Medicine</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('medicines.update', $medicine->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Generic Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $medicine->name }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Trade Name</label>
                                        <input type="text" class="form-control" id="name" name="trade_name" value="{{ $medicine->trade_name }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Dosages</label>
                                        <input type="number" class="form-control"  name="dosage" value="{{ $medicine->dosage }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" name="description">{{ $medicine->description }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="manufacturer" class="form-label">Manufacturer</label>
                                        <input type="text" class="form-control" id="manufacturer" name="manufacturer" value="{{ $medicine->manufacturer }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="category" class="form-label">Category</label>
                                        <select class="form-select" id="category" name="med_category_id">
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ $medicine->med_category_id == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-success">Save Changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
  </div>
</div>
@endsection
