@extends('layouts.admin')
    @section('title', 'Quotes for Clinic: ' . $clinic->name)
    @section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10 mx-auto">
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="card-title">Quotes for {{ $clinic->name }}</h4>
                        <button class="btn btn-primary float-right" data-bs-toggle="modal" data-bs-target="#addQuoteModal">Add Quote</button>
                    </div>

                    <!-- Quotes Table -->
                    <div class="card-body">
                        @if($quotes->isEmpty())
                            <p>No quotes added yet.</p>
                        @else
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Procedure</th>
                                        <th>Price</th>
                                        <th>Duration</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($quotes as $quote)
                                        <tr>
                                            <td>{{ $quote->id }}</td>
                                            <td>{{ $quote->name }}</td>
                                            <td>{{ $quote->procedure }}</td>
                                            <td>${{ number_format($quote->price, 2) }}</td>
                                            <td>{{ $quote->duration }}</td>
                                            <td>
                                                <!-- Edit Quote Button -->
                                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editQuoteModal{{ $quote->id }}">Edit</button>

                                                <!-- Delete Quote -->
                                                <form action="{{ route('admin.quote.destroy', $quote->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this quote?');">Delete</button>
                                                </form>
                                            </td>
                                        </tr>

                                        <!-- Edit Quote Modal -->
                                        <div class="modal fade" id="editQuoteModal{{ $quote->id }}" tabindex="-1" aria-labelledby="editQuoteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editQuoteModalLabel">Edit Quote</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('admin.quote.update', $quote->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <label for="name" class="form-label">Quote Name</label>
                                                                <input type="text" class="form-control" id="name" name="name" value="{{ $quote->name }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="procedure" class="form-label">Procedure</label>
                                                                <input type="text" class="form-control" id="procedure" name="procedure" value="{{ $quote->procedure }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="price" class="form-label">Price</label>
                                                                <input type="number" class="form-control" id="price" name="price" value="{{ $quote->price }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="duration" class="form-label">Duration</label>
                                                                <input type="text" class="form-control" id="duration" name="duration" value="{{ $quote->duration }}" required>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>

                <!-- Add Quote Modal -->
                <div class="modal fade" id="addQuoteModal" tabindex="-1" aria-labelledby="addQuoteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addQuoteModalLabel">Add Quote</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('admin.quote.store', $clinic->id) }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Quote Name</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="procedure" class="form-label">Procedure</label>
                                        <input type="text" class="form-control" id="procedure" name="procedure" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Price</label>
                                        <input type="number" class="form-control" id="price" name="price" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="duration" class="form-label">Duration</label>
                                        <input type="text" class="form-control" id="duration" name="duration" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Add Quote</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
