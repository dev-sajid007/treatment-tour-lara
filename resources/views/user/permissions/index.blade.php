@extends('layouts.admin')

@section('content')
    <h3>Manage Permissions</h3>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="mt-3 mb-3">

        <form action="{{ route('permissions.create') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="permission">Permission Name</label>
                <input type="text" name="permission" id="permission" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary mt-2">Create Permission</button>
        </form>

    </div>

    <h2 class="mt-4">Existing Permissions</h2>
    <ul class="list-group">
        @foreach($permissions as $permission)
            <li class="list-group-item">
                {{ $permission->name }}
                <form action="{{ route('permissions.delete', $permission->name) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm float-right">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
