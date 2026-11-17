@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-4">
    <h4>Edit FAQ</h4>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('faqs.update', $faq->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">FAQ Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $faq->title) }}">
        </div>

        <div class="form-group">
            <label for="description">FAQ Description</label>
            <textarea name="description" rows="5" class="form-control">{{ old('description', $faq->description) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Update FAQ</button>
        <a href="{{ route('faqs.index') }}" class="btn btn-secondary mt-2">Back</a>
    </form>
</div>
@endsection
