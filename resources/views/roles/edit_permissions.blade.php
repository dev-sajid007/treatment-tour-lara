@extends('layouts.admin')

@section('content')
<div class="">
    <h3 class="mb-4">Edit Permissions for Role: {{ $role->name }}</h3>

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

    <form action="{{ route('roles.updatePermissions', $role->name) }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="permissions">Select Permissions</label>
            <div class="d-flex flex-wrap">
                @foreach($permissions as $permission)
                    <div class="form-check me-3">
                        <input 
                            type="checkbox" 
                            name="permissions[]" 
                            id="permission_{{ $permission->id }}" 
                            value="{{ $permission->name }}" 
                            class="form-check-input"
                            @if($role->hasPermissionTo($permission->name)) checked @endif
                        >
                        <label for="permission_{{ $permission->id }}" class="form-check-label">
                            {{ $permission->name }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Update Permissions</button>
    </form>
</div>
@endsection
