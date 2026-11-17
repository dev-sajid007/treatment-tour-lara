@extends('layouts.admin')

@section('content')


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.0/classic/ckeditor.js"></script>

<div class="container-fluid">
    <div class="card border-0 p-4">
        <div class="card shadow-lg">
            <div class="card-body">
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
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
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
        </div>
    </div>
</div>


<script>
      ClassicEditor
        .create(document.querySelector('#bio'))
        .catch(error => {
            console.error('CKEditor error:', error);
        });

    ClassicEditor
        .create(document.querySelector('#qualification'))
        .catch(error => {
            console.error('CKEditor error:', error);
        });
</script>



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
                $(this).toggle(stateCountryId == selectedCountryId || !selectedCountryId);
            });

            // Reset State selection
            $('#state_id').val(null).trigger('change');
        });

    });




</script>



@endsection
