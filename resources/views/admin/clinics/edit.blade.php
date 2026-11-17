@extends('layouts.admin')
    @section('title', 'Edit Clinic')
    @section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Clinic</h4>
                    </div>
                    <div class="card-body">
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
                        <form action="{{ route('admin.clinics.update', $clinic->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="user_id" class="form-label">Select Clinic User</label>
                                <select name="user_id" id="user_id">
                                    <option value="">Select a Clinic User</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" {{ $clinic->user_id == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>                            
                            <div class="mb-3">
                                <label for="name" class="form-label">Clinic Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $clinic->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Clinic Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ $clinic->email }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <!-- Quill Editor -->
                                <div id="description-editor" class="form-control" style="height: 200px;">{!! $clinic->description !!}</div>
                                <input type="hidden" id="description" name="description">
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address" value="{{ $clinic->address }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="main_image" class="form-label">Main Image</label>
                                <input type="file" class="form-control" id="main_image" name="main_image">
                                @if($clinic->main_image)
                                    <img src="{{ asset('storage/img/' . $clinic->main_image) }}" width="200" />
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="gallery_images" class="form-label">Gallery Images</label>
                                <input type="file" class="form-control" id="gallery_images" name="gallery_images[]" multiple>

                                <!-- Display existing gallery images with delete option -->
                                <div class="mt-3" id="gallery-preview">
                                    @if($clinic->gallery_images)
                                        @foreach(json_decode($clinic->gallery_images) as $image)
                                            <div class="gallery-image-wrapper" style="display:inline-block; position:relative; margin-right:10px;">
                                                <img src="{{ asset('storage/img/' . $image) }}" width="100" />
                                                <button type="button" class="delete-image" data-image="{{ $image }}" style="position:absolute; top:0; right:0; background:red; color:white; border:none;">X</button>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="map_embed_code" class="form-label">Map Embed Code</label>
                                <textarea class="form-control" id="map_embed_code" name="map_embed_code">{{ $clinic->map_embed_code }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="country_id" class="form-label">Select Country</label>
                                <select class="form-control" id="country_id" name="country_id" required>
                                    <option value="">Select a country</option>
                                    @foreach($countries as $country)
                                    <option value="{{ $country->id }}" {{ $clinic->country_id == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="state_id" class="form-label">Select State</label>
                                <select class="form-control" id="state_id" name="state_id" required>
                                    @foreach($states as $state)
                                    <option value="{{ $state->id }}" {{ $clinic->state_id == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="categories" class="form-label">Select Categories</label>
                                <select id="categories" name="categories[]" multiple required>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ in_array($category->id, $clinic->categories->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="subcategories" class="form-label">Select Subcategories</label>
                                <select id="subcategories" name="subcategories[]" multiple required>
                                    @foreach($subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}" {{ in_array($subcategory->id, $clinic->subcategories->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $subcategory->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="specialities" class="form-label">Select Speciality</label>
                                <select class="form-control" id="specialities" name="specialities[]" multiple required>
                                    @foreach($specialities as $speciality)
                                    <option value="{{ $speciality->id }}" {{ in_array($speciality->id, $clinic->specialities->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $speciality->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" id="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
          // Initialize TomSelect for categories and subcategories
          document.addEventListener('DOMContentLoaded', function () {
            new TomSelect("#categories", {
                plugins: ['remove_button'],
                create: false,
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });

            new TomSelect("#subcategories", {
                plugins: ['remove_button'],
                create: false,
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });
            new TomSelect("#specialities", {
                plugins: ['remove_button'],
                create: false,
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });
            new TomSelect("#user_id");
        });
        // Initialize Quill editor
        document.addEventListener('DOMContentLoaded', function () {
            var quill = new Quill('#description-editor', {
                theme: 'snow'
            });

            // Sync Quill content with the textarea on form submit
            document.querySelector('#submit').onclick = function() {
                document.querySelector('#description').value = quill.root.innerHTML;
            };

            // Handle image delete via AJAX
            document.querySelectorAll('.delete-image').forEach(function(button) {
                button.addEventListener('click', function() {
                    var image = this.getAttribute('data-image');
                    var clinicId = {{ $clinic->id }};
                    var token = "{{ csrf_token() }}";

                    if (confirm('Are you sure you want to delete this image?')) {
                        $.ajax({
                            url: '/admin/clinics/' + clinicId + '/gallery-image',
                            type: 'DELETE',
                            data: {
                                _token: token,
                                image: image
                            },
                            success: function(response) {
                                location.reload(); // Reload the page after successful deletion
                            }
                        });
                    }
                });
            });
        });

        // Handle dynamic loading of states based on selected country
        $('#country_id').on('change', function () {
            var countryId = $(this).val();
            $.ajax({
                url: '/admin/states-by-country/' + countryId,
                type: 'GET',
                success: function (data) {
                    $('#state_id').html(data);
                }
            });
        });
    </script>
@endsection
