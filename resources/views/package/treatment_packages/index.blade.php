@extends('layouts.admin')

@section('content')
<div class="container-fluid">
   <div class="card border-0 p-4">
        <h2>Treatment Packages List</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('treatment-packages.create') }}" class="btn btn-primary mb-3">Add New Package</a>

        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Country</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($packages as $package)
                    <tr>
                        <td>{{ $package->package_name }}</td>
                        <td>{{ $package->category->category_name }}</td>
                        <td>{{ $package->country->name }}</td>
                        <td>{{ $package->price }}</td>
                        <td>{{ $package->status }}</td>
                        <td>
                            <img src="{{ asset($package->image) }}" alt="{{ $package->package_name }}" width="100">
                        </td>
                        <td>
                            <a href="{{ route('treatment-packages.edit', $package->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('treatment-packages.destroy', $package->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>


    </div>
</div>



@endsection
