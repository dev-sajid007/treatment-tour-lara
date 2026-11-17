@extends('layouts.admin')

@section('content')
<div class="container-fluid py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4">Page Generations</h1>
        <a href="{{ route('page_generations.create') }}" class="btn btn-primary">+ Create New</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive bg-white shadow rounded">
        <table class="table table-bordered table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Page Name</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Placement</th>
                    <th scope="col" style="width: 150px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pageGenerations as $page)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $page->page_name }}</td>
                        <td>{{ $page->slug }}</td>
                        <td>{{ ucfirst($page->placement) }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('page_generations.edit', $page->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                <form action="{{ route('page_generations.destroy', $page->id) }}" method="POST" onsubmit="return confirm('Delete this page?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-3">No page generations found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
