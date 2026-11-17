@extends('layouts.admin')
    @section('title', 'Portfolios for Clinic: ' . $clinic->name)
    @section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10 mx-auto">
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="card-title">Add Portfolio for {{ $clinic->name }}</h4>
                    </div>
                    <div class="row">
                         <div class="col-md-6">
                            @if(session('success'))
                                <div class="alert text-white bg-success" role="alert">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="iq-success-text">{{ session('success') }}</div>
                                        <button type="button" class="close btn btn-danger ms-4" aria-label="Close" onclick="closeAlert(this)">
                                            X
                                        </button>
                                    </div>
                                </div>
                                @endif

                                @if ($errors->any())
                                <div class="alert text-white bg-danger" role="alert">
                                    @foreach ($errors->all() as $error)
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="iq-alert-text">{{ $error }}</div>
                                        <button type="button" data-dismiss="alert" class="close btn btn-danger ms-4" aria-label="Close" onclick="closeAlert(this)">
                                            X
                                        </button>
                                    </div>
                                    @endforeach
                                </div>
                                @endif
                         </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('clinics.portfolios.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Portfolio Title</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Portfolio Image</label>
                                <input type="file" class="form-control" id="image" name="image" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Portfolio</button>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Existing Portfolios for {{ $clinic->name }}</h4>
                    </div>
                    <div class="card-body">
                        @if($portfolios->isEmpty())
                            <p>No portfolios added yet.</p>
                        @else
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Image</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($portfolios as $portfolio)
                                        <tr>
                                            <td>{{ $portfolio->id }}</td>
                                            <td>{{ $portfolio->title }}</td>
                                            <td>
                                                <img src="{{ asset('storage/portfolio/' . $portfolio->image) }}" width="100" />
                                            </td>
                                            <td>
                                                <!-- Delete Portfolio -->
                                                <form action="{{ route('clinics.portfolios.destroy', $portfolio->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this portfolio?');">
                                                        Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        function closeAlert(button) {
            button.parentElement.parentElement.remove();
        }
    </script>
@endsection
