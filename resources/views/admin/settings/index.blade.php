@extends('layouts.admin')
    @section('title', 'Settings')
    @section('content')

    <div class="wrapper">
        <div class="content-page">
            <div class="container-fluid">
                <div class="container">
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
                    <br>
                </div>
                <div class="row">
                    <div class="col-md-10 mx-auto">
                        <!-- Tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#software_settings" role="tab">Software Settings</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#security" role="tab">Security</a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <!-- Software Settings Tab -->
                            <div class="tab-pane active" id="software_settings" role="tabpanel">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between">
                                        <div class="header-title">
                                            <h4 class="card-title">Software Settings</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            <div class="form-group">
                                                <label for="website_name">Website Name</label>
                                                <input type="text" class="form-control" id="website_name" name="website_name" value="{{ $settings->website_name ?? '' }}">
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label for="logo">Logo</label>
                                                <input type="file" class="form-control" id="logo" name="logo"> <br>
                                                @if(isset($settings->logo))
                                                    <img src="{{ Storage::url('img/' . $settings->logo) }}" alt="Logo" style="max-width: 100px;">
                                                @endif
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label for="favicon">Favicon</label>
                                                <input type="file" class="form-control" id="favicon" name="favicon"> <br>
                                                @if(isset($settings->favicon))
                                                    <img src="{{ Storage::url('img/' . $settings->favicon) }}" alt="Favicon" style="max-width: 100px;">
                                                @endif
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label for="business_email">Business Email</label>
                                                <input type="email" class="form-control" id="business_email" name="business_email" value="{{ $settings->business_email ?? '' }}">
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label for="business_phone">Business Phone Number</label>
                                                <input type="text" class="form-control" id="business_phone" name="business_phone" value="{{ $settings->business_phone ?? '' }}">
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <input type="text" class="form-control" id="address" name="address" value="{{ $settings->address ?? '' }}">
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label for="currency">Default Currency Icon</label>
                                                <input type="text" class="form-control" id="currency" name="currency" value="{{ $settings->currency ?? '' }}">
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label for="company_foundation_year">Company Foundation Year (Like = {{ date('Y') }})</label>
                                                <input type="text" class="form-control" id="company_foundation_year" name="company_foundation_year" value="{{ $settings->company_foundation_year ?? '' }}">
                                            </div>
                                            <br>
                                            <button type="submit" class="btn btn-primary">Update Software Settings</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Security Tab -->
                            <div class="tab-pane" id="security" role="tabpanel">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between">
                                        <div class="header-title">
                                            <h4 class="card-title">Security Settings</h4>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form method="POST" action="{{ route('password.update') }}">
                                            @csrf
                                            @method('PUT')

                                            <div class="form-group">
                                                <label for="current_password">Current Password</label>
                                                <input type="password" class="form-control" id="current_password" name="current_password" required>
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label for="new_password">New Password</label>
                                                <input type="password" class="form-control" id="new_password" name="new_password" required>
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label for="confirm_password">Confirm Password</label>
                                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                            </div>
                                            <br>
                                            <button type="submit" class="btn btn-primary">Update Security Settings</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Form ends -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function closeAlert(button) {
            button.parentElement.parentElement.remove();
        }
    </script>
@endsection
