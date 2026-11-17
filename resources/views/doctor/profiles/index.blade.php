@extends('layouts.admin')

@section('content')



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.0/classic/ckeditor.js"></script>

<div class="container-fluid">
   <div class="card border-0 p-4">
        <div class="card shadow-lg">
            <div class="card-header text-white text-center" style="background-color: #b00b47;">
                <h2 class="text-white">{{ $auth->name ?? 'Not Available' }}</h2>
                <p class="mb-0">{{ $profile->specialization ?? 'Specialization Not Available' }}</p>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Profile Picture -->
                    <div class="col-md-4 text-center">
                        @if(isset($profile))
                        <img 
                            src="{{asset($profile->profile_picture)}}" 
                            alt="Profile Picture" 
                            class="img-fluid rounded-circle mb-3" 
                            style="width: 150px; height: 150px; object-fit: cover;"
                        >
                        @else
                        <img 
                            src="https://cdni.iconscout.com/illustration/premium/thumb/male-doctor-pointing-in-medical-presentation-illustration-download-svg-png-gif-file-formats--pack-healthcare-illustrations-10913699.png" 
                            alt="Profile Picture" 
                            class="img-fluid rounded-circle mb-3" 
                            style="width: 150px; height: 150px; object-fit: cover;"
                        >
                        @endif
                        <h4 class="text-primary">License: {{ $profile->license_number ?? 'N/A' }}</h4>
                    </div>
                    
                    <!-- Doctor Info -->
                    <div class="col-md-8">
                        <h4>Personal Information</h4>
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Country</th>
                                    <td>{{ $profile->country->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>State</th>
                                    <td>{{ $profile->state->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>City</th>
                                    <td>{{ $profile->city ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td>{{ $profile->address ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Postal Code</th>
                                    <td>{{ $profile->postal_code ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Consultation Fee</th>
                                    <td>${{ $profile->consultation_fee ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                            @if(isset($profile))
                                        <span class="badge bg-{{ $profile->availability_status == 'available' ? 'success' : 'danger' }}">
                                            {{ ucfirst($profile->availability_status) }}
                                        </span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <h4>Professional Details</h4>
                        <p><strong>Qualifications:</strong> {!! $profile->qualification ?? 'N/A' !!}</p>
                        <p><strong>Bio:</strong> {!! $profile->bio ?? 'No bio available.' !!}</p>
                    </div>
                </div>
            </div>
            <div class="card-footer text-center">
                @if(isset($profile))
                <a 
                    class="btn btn-primary"
                    href="{{route('doctor-profiles.edit', $profile->id)}}">
                    Edit Profile
                </a>

                @else
                <a class="btn btn-primary" href="{{route('doctor-profiles.create')}}">
                    Add Doctor Profile
                </a>
                 @endif
                <a href="{{ route('home') }}" class="btn btn-secondary">Back to Dashboard</a>
            </div>
        </div>
    </div>
</div>



<!-- Modal -->
    <div class="modal fade" id="createprofileModal" tabindex="-1" aria-labelledby="createprofileModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createprofileModalLabel">Create Doctor Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('doctor-profiles.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Doctor Information -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="specialization" class="form-label">Specialization</label>
                                    <input type="text" name="specialization" id="specialization" class="form-control" placeholder="Enter Specialization">
                                </div>
                                <div class="mb-3">
                                    <label for="license_number" class="form-label">License Number</label>
                                    <input type="text" name="license_number" id="license_number" class="form-control" placeholder="Enter License Number">
                                </div>
                                <div class="mb-3">
                                    <label for="qualification" class="form-label">Qualification</label>
                                    <textarea name="qualification" id="qualification" class="form-control" rows="2" placeholder="Enter Qualifications"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                 <div class="mb-3">
                                    <label for="country_id" class="form-label">Country</label>
                                    <select name="country_id" id="country_id" class="form-select select2" required>
                                        <option value="">Select Country</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="state_id" class="form-label">State</label>
                                    <select name="state_id" id="state_id" class="form-select select2" required>
                                        <option value="">Select State</option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state->id }}" data-country-id="{{ $state->country_id }}">{{ $state->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                               <div class="mb-3">
                                    <label for="edit_category_id" class="form-label">Expertise</label>
                                    <select name="category_id" id="edit_category_id" class="form-select select2">
                                        <option value="">Select One</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" >
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="city" class="form-label">City</label>
                                    <input type="text" name="city" id="city" class="form-control" placeholder="Enter City">
                                </div>
                                <div class="mb-3">
                                    <label for="profile_picture" class="form-label">Profile Picture</label>
                                    <input type="file" name="profile_picture" id="profile_picture" class="form-control">
                                </div>
                            </div>
                        </div>
                        <!-- Additional Info -->
                        <div class="mb-3">
                            <label for="bio" class="form-label">Bio</label>
                            <textarea name="bio" id="bio" class="form-control" rows="4" placeholder="Write a brief bio..."></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="consultation_fee" class="form-label">Consultation Fee</label>
                            <input type="number" name="consultation_fee" id="consultation_fee" class="form-control" placeholder="Enter Consultation Fee" step="0.01">
                        </div>

                        <div class="mb-3">
                            <label for="availability_status" class="form-label">Availability Status</label>
                            <select name="availability_status" id="availability_status" class="form-select select2" required>
                                <option value="">Select One</option>
                              
                                 <option>available</option>
                                 <option>not_available</option>
                             
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Save Profile</button>
                    </form>
                </div>
                <div class="modal-footer">
<!--                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Profile</button> -->
                </div>
            </div>
        </div>
    </div>


@if(isset($profile))
   <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Edit Doctor Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('doctor-profiles.update', $profile->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!-- Doctor Information -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_specialization" class="form-label">Specialization</label>
                                <input type="text" name="specialization" id="edit_specialization" class="form-control" 
                                       value="{{ $profile->specialization ?? '' }}" placeholder="Enter Specialization">
                            </div>
                            <div class="mb-3">
                                <label for="edit_license_number" class="form-label">License Number</label>
                                <input type="text" name="license_number" id="edit_license_number" class="form-control" 
                                       value="{{ $profile->license_number ?? '' }}" placeholder="Enter License Number">
                            </div>
                            <div class="mb-3">
                                <label for="edit_qualification" class="form-label">Qualification</label>
                                <textarea name="qualification" id="edit_qualification" class="form-control" rows="2" 
                                          placeholder="Enter Qualifications">{{ $profile->qualification ?? '' }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_country_id" class="form-label">Country</label>
                                <select name="country_id" id="edit_country_id" class="form-select select2" required>
                                    <option value="">Select Country</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}" 
                                                {{ (isset($profile->country_id) && $profile->country_id == $country->id) ? 'selected' : '' }}>
                                            {{ $country->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="edit_state_id" class="form-label">State</label>
                                <select name="state_id" id="edit_state_id" class="form-select select2">
                                    <option value="">Select State</option>
                                    @foreach ($states as $state)
                                        <option value="{{ $state->id }}" 
                                                {{ (isset($profile->state_id) && $profile->state_id == $state->id) ? 'selected' : '' }}>
                                            {{ $state->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="edit_category_id" class="form-label">Expertise</label>
                                <select name="category_id" id="edit_category_id" class="form-select select2">
                                    <option value="">Select One</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" 
                                                {{ (isset($profile->category_id) && $profile->category_id == $category->id) ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="edit_city" class="form-label">City</label>
                                <input type="text" name="city" id="edit_city" class="form-control" 
                                       value="{{ $profile->city ?? '' }}" placeholder="Enter City">
                            </div>
                            <div class="mb-3">
                                <label for="edit_profile_picture" class="form-label">Profile Picture</label>
                                <input type="file" name="profile_picture" id="edit_profile_picture" class="form-control">
                                <small>Leave blank if not changing the picture.</small>
                                @if(isset($profile->profile_picture))
                                    <div class="mt-2">
                                        <img src="{{ asset($profile->profile_picture) }}" alt="Profile Picture" class="img-thumbnail" width="100">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- Additional Info -->
                    <div class="mb-3">
                        <label for="edit_bio" class="form-label">Bio</label>
                       <textarea 
                                name="bio" 
                                id="bio" 
                                class="form-control ckeditor" 
                                rows="4" 
                                placeholder="Write a brief bio..."
                            >{{ old('bio', $profile->bio ?? '') }}
                        </textarea>

                    </div>
                    <div class="mb-3">
                        <label for="edit_consultation_fee" class="form-label">Consultation Fee</label>
                        <input type="number" name="consultation_fee" id="edit_consultation_fee" class="form-control" 
                               value="{{ $profile->consultation_fee ?? '' }}" placeholder="Enter Consultation Fee" step="0.01">
                    </div>

                    <div class="mb-3">
                        <label for="edit_availability_status" class="form-label">Availability Status</label>
                        <select name="availability_status" id="edit_availability_status" class="form-select select2" required>
                            <option value="">Select One</option>
                            <option value="available" 
                                    {{ (isset($profile->availability_status) && $profile->availability_status == 'available') ? 'selected' : '' }}>
                                Available
                            </option>
                            <option value="not_available" 
                                    {{ (isset($profile->availability_status) && $profile->availability_status == 'not_available') ? 'selected' : '' }}>
                                Not Available
                            </option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endif



<script>
    $(document).ready(function () {
        // Initialize Select2
        $('.select2').select2();

        // Handle Country Change
        $('#country_id').on('change', function () {
            const selectedCountryId = $(this).val();

            // Show/Hide States based on selected country
            $('#state_id option').each(function () {
                const stateCountryId = $(this).data('country-id');

                if (stateCountryId == selectedCountryId || selectedCountryId === "") {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });

            // Reset State selection
            $('#state_id').val(null).trigger('change');
        });
    });





</script>





    <script>
    document.addEventListener("DOMContentLoaded", function () {
        // Function to initialize CKEditor
        function initializeCKEditor(selector) {
            const bioTextarea = document.querySelector(selector);
            if (bioTextarea) {
                ClassicEditor
                    .create(bioTextarea)
                    .catch(error => console.error(error));
            }
        }

        // Initialize CKEditor when the modal is shown
        $('#editProfileModal').on('shown.bs.modal', function () {
            initializeCKEditor('#bio'); // Ensure this targets the textarea inside the modal
        });

        // Optional: Destroy CKEditor when the modal is hidden to prevent duplicate instances
        $('#editProfileModal').on('hidden.bs.modal', function () {
            const editorInstance = ClassicEditor.instances['bio'];
            if (editorInstance) {
                editorInstance.destroy().catch(error => console.error(error));
            }
        });
    });


    $(document).on('shown.bs.modal', '#createprofileModal, #editProfileModal', function () {
    ClassicEditor.create(document.querySelector('#bio')).catch(error => {
        console.error(error);
    });

    ClassicEditor.create(document.querySelector('#edit_qualification')).catch(error => {
        console.error(error);
    });
});

</script>






@endsection