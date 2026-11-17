@extends('layouts.admin')

@section('content')
    <h3>Manage User Permissions</h3>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('users.editPermissions') }}" method="GET">
        <div class="form-group">
            <label for="user">Select User</label>
            <select name="user" id="user" class="form-control" onchange="this.form.submit()">
                <option value="">--Select a user--</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ isset($selectedUser) && $selectedUser->id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>

    <div class="mt-4">

    @if(isset($selectedUser))
        <form action="{{ route('users.updatePermissions', $selectedUser->id) }}" method="POST">
            @csrf
            @method('PUT')

            <h3>Permissions for {{ $selectedUser->name }}</h3>

            <div class="form-group">
                <label for="permissions">Select Permissions</label>
                <div class="d-flex flex-wrap">
                    @foreach($permissions as $permission)
                        <div class="form-check me-3">
                            <input type="checkbox" name="permissions[]" id="permission_{{ $permission->id }}" 
                                   value="{{ $permission->name }}" class="form-check-input"
                                   {{ in_array($permission->name, $userPermissions) ? 'checked' : '' }}>
                            <label for="permission_{{ $permission->id }}" class="form-check-label">
                                {{ $permission->name }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Update Permissions</button>
        </form>
    @endif

    </div>
@endsection
