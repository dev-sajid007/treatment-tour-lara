@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-4">
    <h4>Add New FAQ</h4>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('faqs.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="title">FAQ Title</label>
            <input type="text" name="title" class="form-control" placeholder="Enter FAQ title" value="{{ old('title') }}">
        </div>

        <div class="form-group">
            <label for="description">FAQ Description</label>
            <textarea name="description" rows="5" class="form-control" placeholder="Enter FAQ description">{{ old('description') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success mt-2">Create FAQ</button>
        <a href="{{ route('faqs.index') }}" class="btn btn-secondary mt-2">Back</a>
    </form>
</div>
@endsection
