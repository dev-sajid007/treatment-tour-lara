@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-4">
    <h4>Add New Podcast</h4>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('podcasts.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="video">Video Link</label>
            <input type="text" name="video" class="form-control" placeholder="Enter video link" value="{{ old('video') }}" required>
        </div>

        <button type="submit" class="btn btn-success mt-2">Create Podcast</button>
        <a href="{{ route('podcasts.index') }}" class="btn btn-secondary mt-2">Back</a>
    </form>
</div>
@endsection
