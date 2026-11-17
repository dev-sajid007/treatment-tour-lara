@extends('layouts.admin')
    @section('title', 'Clinic Details')
    @section('content')

    <div class="container-fluid">
  <div class="card border-0 p-4">
    <h1 class="mt-5">Clinic Dashboard</h1>


    <!-- Dashboard Stats -->
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-header text-dark">Treatments</div>
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p class="card-text">Number of Treatments available.</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header text-dark">Clinic Settings</div>
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p class="card-text">Clinic Settings <strong><a  class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#settingsModal">
  Add Clinic Settings
</a></strong> </p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header text-dark">Clinic Users</div>
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p class="card-text">Number of Total User <a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">Add User</a> </p>
                </div>
            </div>
        </div>
    </div>


  </div>
</div>

<!-- hospital setting Modal -->
<div class="modal fade" id="settingsModal" tabindex="-1" role="dialog" aria-labelledby="settingsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="settingsModalLabel">
          {{ isset($clinicSettings) ? 'Edit' : 'Add' }} Clinic Settings
        </h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Modal Form -->
      <form action="{{ isset($clinicSettings) ? route('clinic.settings.update', $clinicSettings->id) : route('clinic.settings.store', $clinic->id) }}" method="POST">
        @csrf
        @if(isset($clinicSettings))
          @method('PUT') <!-- For editing, use PUT method -->
        @endif
        <div class="modal-body">
          <!-- Social Media Fields -->
          <div class="form-group">
            <label for="facebook">Facebook</label>
            <input type="text" class="form-control" name="facebook" id="facebook" value="{{ old('facebook', $clinicSettings->facebook ?? '') }}">
          </div>
          
          <div class="form-group">
            <label for="instagram">Instagram</label>
            <input type="text" class="form-control" name="instagram" id="instagram" value="{{ old('instagram', $clinicSettings->instagram ?? '') }}">
          </div>
          
          <div class="form-group">
            <label for="twitter">Twitter</label>
            <input type="text" class="form-control" name="twitter" id="twitter" value="{{ old('twitter', $clinicSettings->twitter ?? '') }}">
          </div>

          <div class="form-group">
            <label for="linkedin">LinkedIn</label>
            <input type="text" class="form-control" name="linkedin" id="linkedin" value="{{ old('linkedin', $clinicSettings->linkedin ?? '') }}">
          </div>

          <div class="form-group">
            <label for="youtube">YouTube</label>
            <input type="text" class="form-control" name="youtube" id="youtube" value="{{ old('youtube', $clinicSettings->youtube ?? '') }}">
          </div>

          <div class="form-group">
            <label for="website">Website</label>
            <input type="text" class="form-control" name="website" id="website" value="{{ old('website', $clinicSettings->website ?? '') }}">
          </div>

          <!-- Text Fields for Hospital Info -->
          <div class="form-group">
            <label for="speciality">Speciality</label>
            <textarea class="form-control" name="speciality" id="speciality">{{ old('speciality', $clinicSettings->speciality ?? '') }}</textarea>
          </div>

          <div class="form-group">
            <label for="infrastructure">Infrastructure</label>
            <textarea class="form-control" name="infrastructure" id="infrastructure">{{ old('infrastructure', $clinicSettings->infrastructure ?? '') }}</textarea>
          </div>

          <div class="form-group">
            <label for="facility">Facility</label>
            <textarea class="form-control" name="facility" id="facility">{{ old('facility', $clinicSettings->facility ?? '') }}</textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">
            {{ isset($clinicSettings) ? 'Update Settings' : 'Save Settings' }}
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
                <h5 class="modal-title" id="addUserModalLabel">Add Clinic User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Add User Form -->
                <form action="{{ route('clinic.users.store', $clinic->id) }}" method="POST">
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

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 mx-auto">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h4 style="color: #fff;">Clinic Details</h4>
                    </div>
                    <div class="card-body">
                        <!-- Name and Description -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h5 class="text-primary">Clinic Name:</h5>
                                <p class="fs-5">{{ $clinic->name ?? ''}}</p>
                            </div>
                            <div class="col-md-6">
                                <h5 class="text-primary">Description:</h5>
                                <p class="fs-5">{!! $clinic->description !!}</p>
                            </div>
                        </div>

                        <!-- Country and State -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h5 class="text-primary">Country:</h5>
                                <p class="fs-5">{{ $clinic->country->name ?? ''}}</p>
                            </div>
                            <div class="col-md-6">
                                <h5 class="text-primary">State:</h5>
                                <p class="fs-5">{{ $clinic->state->name ?? ''}}</p>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <h5 class="text-primary">Full Address:</h5>
                                <p class="fs-5">{{ $clinic->address ?? ''}}</p>
                            </div>
                        </div>
                        <!-- Map Embed Code -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary">Location:</h5>
                                <div class="border p-2">{!! $clinic->map_embed_code !!}</div>
                            </div>
                        </div>

                        <!-- Categories and Subcategories -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h5 class="text-primary">Categories:</h5>
                                <ul class="list-group">
                                    @foreach($clinic->categories as $category)
                                        <li class="list-group-item">{{ $category->name ?? ''}}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h5 class="text-primary">Subcategories:</h5>
                                <ul class="list-group">
                                    @foreach($clinic->subcategories as $subcategory)
                                        <li class="list-group-item">{{ $subcategory->name ?? ''}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <!-- Main Image -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary">Main Image:</h5>
                                @if($clinic->main_image)
                                    <img src="{{ asset('storage/img/' . $clinic->main_image) }}" class="img-thumbnail" width="300" />
                                @else
                                    <p class="text-muted">No main image available</p>
                                @endif
                            </div>
                        </div>

                        <!-- Gallery Images -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="text-primary">Gallery Images:</h5>
                                <div class="d-flex flex-wrap gap-3">
                                    @if($clinic->gallery_images)
                                        @foreach(json_decode($clinic->gallery_images) as $image)
                                            <img src="{{ asset('storage/img/' . $image) }}" class="img-thumbnail" width="150" />
                                        @endforeach
                                    @else
                                        <p class="text-muted">No gallery images available</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
