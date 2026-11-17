@extends('layouts.admin')
    @section('title', 'Users List')
    @section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <a href="{{ route('users.create') }}" class="btn btn-primary mb-3"><i class="fas fa-user-plus"></i> Add User</a>
                <div class="card">
                    <div class="card-header">
                        <h4>Users List</h4>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>User Type</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td> 
                                            @foreach($user->roles as $role)
                                            <span class="bg-blue-500 px-2 py-1 rounded">{{ $role->name }}</span>
                                            @endforeach 
                                        </td>
                                        <td>
                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger delete-btn"><i class="fas fa-trash-alt"></i></button>
                                            </form>
                                            <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#changePasswordModal-{{ $user->id }}"><i class="fas fa-key"></i></button>
                                            
                                        </td>
                                    </tr>

                                    <!-- Change Password Modal -->
                                    <div class="modal fade" id="changePasswordModal-{{ $user->id }}" tabindex="-1" aria-labelledby="changePasswordModalLabel-{{ $user->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="changePasswordModalLabel-{{ $user->id }}">Change Password</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('users.changePassword', $user->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="password" class="form-label">New Password</label>
                                                            <input type="password" class="form-control password" name="password" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                                            <input type="password" class="form-control password_confirmation" name="password_confirmation" required>
                                                            <div class="invalid-feedback d-none">Passwords do not match</div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary change-password-submit">Change Password</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.delete-btn').forEach(function (button) {
                button.addEventListener('click', function () {
                    var form = this.closest('.delete-form');
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    })
                });
            });

            document.querySelectorAll('.change-password-submit').forEach(function (button) {
                button.addEventListener('click', function (e) {
                    var modal = this.closest('.modal-content');
                    var password = modal.querySelector('.password').value;
                    var passwordConfirmation = modal.querySelector('.password_confirmation').value;
                    if (password !== passwordConfirmation) {
                        e.preventDefault();
                        modal.querySelector('.password_confirmation').classList.add('is-invalid');
                        modal.querySelector('.invalid-feedback').classList.remove('d-none');
                    } else {
                        modal.querySelector('.password_confirmation').classList.remove('is-invalid');
                        modal.querySelector('.invalid-feedback').classList.add('d-none');
                    }
                });
            });
        });
    </script>
@endsection
