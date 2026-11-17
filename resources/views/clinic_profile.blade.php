@extends('layouts.admin')
    @section('title', 'Edit Profile')
    @section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 mx-auto">
                @if(session('success'))
                    <div class="alert text-white bg-success" role="alert">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="iq-success-text">{{ session('success') }}</div>
                            <button type="button" class="close btn btn-danger ms-4" aria-label="Close" onclick="closeAlert(this)">
                                X
                            </button>
                        </div>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert text-white bg-danger" role="alert">
                        @foreach ($errors->all() as $error)
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="iq-alert-text">{{ $error }}</div>
                                <button type="button" data-dismiss="alert" class="close btn btn-danger ms-4" aria-label="Close" onclick="closeAlert(this)">
                                    X
                                </button>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="profile-img-container mb-5 text-center">
                            @if (Auth::user()->profile_image)
                                <img src="{{ asset('storage/img/' . Auth::user()->profile_image) }}" alt="Profile Image" class="rounded-circle img-thumbnail" width="150px">
                            @else
                                <img src="https://via.placeholder.com/150" alt="Profile Image" class="rounded-circle img-thumbnail" width="150px">
                            @endif
                            <h3>{{ Auth::user()->name }}</h3>
                            <p class="text-muted">{{ Auth::user()->user_type }}</p>
                        </div>
                        <br>
                        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="text-left">
                            @csrf
                            @method('PUT')
                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" id="name" name="name" value="{{ Auth::user()->name }}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" id="email" name="email" value="{{ Auth::user()->email }}" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row my-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user_type" class="form-label">User Type</label>
                                        <input type="text" id="user_type" name="user_type" value="{{ Auth::user()->user_type }}" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" id="phone" name="phone" value="{{ Auth::user()->phone }}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="profile_image" class="form-label">Profile Image</label>
                                        <input type="file" id="profile_image" name="profile_image" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-4">
                                <input type="submit" value="Update Profile" class="btn btn-outline-success">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .profile-img-container {
            position: relative;
            width: 150px;
            height: 150px;
            margin: 0 auto;
        }

        .profile-img-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #fff;
        }

        .profile-img-container:after {
            content: "";
            display: block;
            padding-bottom: 100%;
        }
    </style>

    <script>
        function closeAlert(button) {
            button.parentElement.parentElement.remove();
        }
    </script>
@endsection
