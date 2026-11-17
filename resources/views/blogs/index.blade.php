@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h2>Blog Posts</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('blogs.create') }}" class="btn btn-primary mb-3">Create New Blog</a>

    @if($blogs->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($blogs as $blog)
                    <tr>
                        <td>
                            @if($blog->image && $blog->image !== 'uploads/blog/no.png')
                                <img src="{{ asset($blog->image) }}" alt="Blog Image" width="100">
                            @else
                                <span>No Image</span>
                            @endif
                        </td>
                        <td>{{ $blog->title }}</td>
                        <td>{{ $blog->slug }}</td>
                        <td>
                            <a href="{{ route('blogs.show', $blog->slug) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this blog?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No blog posts available.</p>
    @endif
</div>
@endsection
