@extends('layouts.admin')

@section('content')

<div class="">
    <h3>Manage Roles</h3>

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

    {{-- Role Creation Form --}}
    <div class="mt-2 mb-2">
        <form action="{{ route('roles.create') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="role">Role Name</label>
                <input type="text" name="role" id="role" class="form-control" required>
            </div>

            <div class="form-group mt-4 mb-3">
                <label for="permissions">Assign Permissions</label>
                <div class="d-flex flex-wrap">
                    @foreach($permissions as $permission)
                        <div class="form-check me-3">
                            <input type="checkbox" name="permissions[]" id="permission_{{ $permission->id }}" value="{{ $permission->name }}" class="form-check-input">
                            <label for="permission_{{ $permission->id }}" class="form-check-label">{{ $permission->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Create Role & Assign Permissions</button>
        </form>
    </div>

    <div class="mt-2 mb-2">
            <h2 class="mt-4">Existing Roles</h2>
            <div class="d-flex flex-wrap">
                @foreach($roles as $role)
                    <div class="list-group-item me-3 mb-2" style="min-width: 200px;">
                        {{ $role->name }}
                        <a href="{{route('roles.editPermissions', $role->name)}}">Edit</a>
                        <form action="{{ route('roles.delete', $role->name) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm float-right">Delete</button>
                        </form>
                    </div>
                @endforeach
            </div>
    </div>
</div>

@endsection
