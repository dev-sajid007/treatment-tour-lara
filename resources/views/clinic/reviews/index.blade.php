<x-clinic>
    @section('title', 'Reviews for Clinic: ' . $clinic->name)

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10 mx-auto">
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="card-title">Add Review for {{ $clinic->name }}</h4>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mx-auto">
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

                            <div class="card-body">
                                <form action="{{ route('clinics.reviews.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Your Name</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="date" class="form-label">Date</label>
                                        <input type="date" class="form-control" id="date" name="date" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="review" class="form-label">Review</label>
                                        <textarea class="form-control" id="review" name="review" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="rating" class="form-label">Rating (1-5)</label>
                                        <input type="text" class="form-control" id="rating" name="rating" min="1" max="5" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Add Review</button>
                                </form>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Existing Reviews for {{ $clinic->name }}</h4>
                    </div>
                    <div class="card-body">
                        @if($reviews->isEmpty())
                            <p>No reviews added yet.</p>
                        @else
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Date</th>
                                        <th>Review</th>
                                        <th>Rating</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reviews as $review)
                                        <tr>
                                            <td>{{ $review->id }}</td>
                                            <td>{{ $review->name }}</td>
                                            <td>{{ $review->date }}</td>
                                            <td>{{ $review->review }}</td>
                                            <td>{{ $review->rating }}</td>
                                            <td>
                                                <!-- Delete Review -->
                                                <form action="{{ route('clinics.reviews.destroy', $review->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this review?');">
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
</x-clinic>
