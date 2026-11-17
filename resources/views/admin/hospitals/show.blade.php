@extends('layouts.admin')

@section('content')
<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
<div class="container-fluid">
  <div class="card border-0 p-4">
    <h1 class="mt-5">Hospital Dashboard</h1>


    <!-- Dashboard Stats -->
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-header text-dark">Packages</div>
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p class="card-text">  <strong><a  href="{{route('treatment-packages.create')}}" class="btn btn-primary">
  Treatment Packages
</a></strong></p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header text-dark">Manage Hospital</div>
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p class="card-text"><strong><a  class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#manageHospitalModal">
 Manage Hospital
</a></strong> </p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header text-dark">Hospital social Settings</div>
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p class="card-text"><strong><a  class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#settingsModal">
 Hospital social Settings
</a></strong> </p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header text-dark">Hospital Users</div>
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p class="card-text"><a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">Add User</a> </p>
                </div>
            </div>
        </div>
    </div>


  </div>
</div>



<!-- Manage hospital Modal -->
<div class="modal fade" id="manageHospitalModal" tabindex="-1" role="dialog" aria-labelledby="manageHospitalModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="manageHospitalModalLabel">
          Manage Hospital
        </h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Modal Form -->
        <form action="{{route('admin.hospitals.update', $hospital->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="modal-body">


          <!-- Name -->
          <div class="form-group">
            <label for="name">Hospital Name</label>
            <input type="text" class="form-control" name="name" value="{{ old('name', $hospital->name) }}" required>
          </div>

          <!-- Address -->
          <div class="form-group">
            <label for="address">Address</label>
            <textarea class="form-control" name="address" rows="2">{{ old('address', $hospital->address) }}</textarea>
          </div>



          <!-- Country Dropdown -->
          <div class="form-group">
            <label for="country_id">Country</label>
            <select class="form-control" id="country_id" name="country_id" required>
              <option value="">Select Country</option>
              @foreach($countries as $country)
                <option value="{{ $country->id }}" {{ old('country_id', $hospital->country_id) == $country->id ? 'selected' : '' }}>
                  {{ $country->name }}
                </option>
              @endforeach
            </select>
          </div>

          <!-- City Dropdown -->
          <div class="form-group">
            <label for="city_id">City</label>
            <select class="form-control" id="city_id" name="city_id" required>
              <option value="">Select City</option>
              @foreach($cities as $city)
                <option value="{{ $city->id }}"
                        data-country="{{ $city->country_id }}"
                        {{ old('city_id', $hospital->city_id) == $city->id ? 'selected' : '' }}>
                  {{ $city->name }}
                </option>
              @endforeach
            </select>
          </div>



          <!-- Established -->
          <div class="form-group">
            <label for="established">Established</label>
            <input type="text" class="form-control" name="established" value="{{ old('established', $hospital->established) }}">
          </div>

          <div class="form-group">
            <label for="website">Website</label>
            <input type="text" class="form-control" name="website" id="website" value="{{ old('website', $hospital->website ?? '') }}">
          </div>

          <div class="form-group">
            <label for="phone_number">Phone Number</label>
            <input type="text" class="form-control" name="phone_number" id="phone_number" value="{{ old('phone_number', $hospital->phone_number ?? '') }}">
          </div>

          <!-- No. of Beds -->
          <div class="form-group">
            <label for="no_of_beds">Number of Beds</label>
            <input type="number" class="form-control" name="no_of_beds" value="{{ old('no_of_beds', $hospital->no_of_beds) }}">
          </div>

          <!-- Speciality Type -->
          <div class="form-group">
            <label for="speciality_type">Speciality Type</label>
            <input type="text" class="form-control" name="speciality_type" value="{{ old('speciality_type', $hospital->speciality_type) }}">
          </div>

          <!-- Speciality -->
          <div class="form-group">
            <label for="speciality">Speciality</label>
            <textarea class="form-control" name="speciality" rows="2">{{ old('speciality', $hospital->Speciality) }}</textarea>
          </div>

          <!-- Infrastructure -->
          <div class="form-group">
            <label for="infrastructure">Infrastructure</label>
            <textarea class="form-control" name="infrastructure" rows="2">{{ old('infrastructure', $hospital->Infrastructure) }}</textarea>
          </div>

          <!-- Facility -->
          <div class="form-group">
            <label for="facility">Facility</label>
            <textarea class="form-control" name="facility" rows="2">{{ old('facility', $hospital->Facility) }}</textarea>
          </div>

          <!-- Description -->
          <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3">{!! $hospital->description !!}</textarea>
          </div>

          <!-- Image -->
          <div class="form-group">
            <label for="image">Hospital Image</label>
            <input type="file" class="form-control-file" name="image">
            @if ($hospital->image)
              <small class="form-text text-muted">Current image: {{ $hospital->image }}</small>
              <img src="{{ asset('storage/images/hospitals/' . $hospital->image) }}" alt="Hospital Image" style="max-width: 100px; margin-top: 5px;">
            @endif
          </div>
        </div>

        <div class="modal-footer">

          <button type="submit" class="btn btn-primary">Update Hospital</button>
        </div>
      </form>
    </div>
  </div>
</div>




<!-- hospital setting Modal -->
<div class="modal fade" id="settingsModal" tabindex="-1" role="dialog" aria-labelledby="settingsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="settingsModalLabel">
          {{ isset($hospitalSettings) ? 'Edit' : 'Add' }} Hospital Settings
        </h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Modal Form -->
      <form action="{{ isset($hospitalSettings) ? route('hospital.settings.update', $hospitalSettings->id) : route('hospital.settings.store', $hospital->id) }}" method="POST">
        @csrf
        @if(isset($hospitalSettings))
          @method('PUT') <!-- For editing, use PUT method -->
        @endif
        <div class="modal-body">
          <!-- Social Media Fields -->
          <div class="form-group">
            <label for="facebook">Facebook</label>
            <input type="text" class="form-control" name="facebook" id="facebook" value="{{ old('facebook', $hospitalSettings->facebook ?? '') }}">
          </div>
          
          <div class="form-group">
            <label for="instagram">Instagram</label>
            <input type="text" class="form-control" name="instagram" id="instagram" value="{{ old('instagram', $hospitalSettings->instagram ?? '') }}">
          </div>
          
          <div class="form-group">
            <label for="twitter">Twitter</label>
            <input type="text" class="form-control" name="twitter" id="twitter" value="{{ old('twitter', $hospitalSettings->twitter ?? '') }}">
          </div>

          <div class="form-group">
            <label for="linkedin">LinkedIn</label>
            <input type="text" class="form-control" name="linkedin" id="linkedin" value="{{ old('linkedin', $hospitalSettings->linkedin ?? '') }}">
          </div>

          <div class="form-group">
            <label for="youtube">YouTube</label>
            <input type="text" class="form-control" name="youtube" id="youtube" value="{{ old('youtube', $hospitalSettings->youtube ?? '') }}">
          </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">
            {{ isset($hospitalSettings) ? 'Update Settings' : 'Save Settings' }}
          </button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- add user modal -->


<!-- Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add Hospital User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Add User Form -->
                <form action="{{ route('hospital.users.store', $hospital->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- CKEditor 5 Initialization -->
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.0/classic/ckeditor.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    ClassicEditor
      .create(document.querySelector('#speciality'))
      .catch(error => {
        console.error(error);
      });

    ClassicEditor
      .create(document.querySelector('#infrastructure'))
      .catch(error => {
        console.error(error);
      });

    ClassicEditor
      .create(document.querySelector('#facility'))
      .catch(error => {
        console.error(error);
      });
  });
</script>


<script>
  document.addEventListener('DOMContentLoaded', function () {
    const countrySelect = document.getElementById('country_id');
    const citySelect = document.getElementById('city_id');
    const allCities = Array.from(citySelect.options);

    function filterCities() {
      const selectedCountry = countrySelect.value;

      // Reset and filter
      citySelect.innerHTML = '<option value="">Select City</option>';
      allCities.forEach(option => {
        if (option.dataset.country === selectedCountry) {
          citySelect.appendChild(option);
        }
      });
    }

    // Initial filter if editing
    if (countrySelect.value) {
      filterCities();
    }

    // On change
    countrySelect.addEventListener('change', filterCities);
  });
</script>


 <script>
        // Initialize CKEditor with upload functionality
        ClassicEditor
            .create(document.querySelector('#description'), {
                ckfinder: {
                    // Use the defined route for file uploads
                    uploadUrl: "{{ route('ckeditor.upload') }}?_token={{ csrf_token() }}"
                }
            })
            .then(editor => {
                console.log('Editor initialized', editor);
            })
            .catch(error => {
                console.error('Error initializing editor:', error);
            });
    </script>


@endsection
