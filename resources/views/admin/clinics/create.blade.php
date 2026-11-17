@extends('layouts.admin')
    @section('title', 'Add Clinic')
    @section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h4>Add Clinic</h4>
                    </div>
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
                    <div class="card-body">
                        <form action="{{ route('admin.clinics.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="user_id" class="form-label">Select Clinic User</label>
                                <select name="user_id" id="user_id">
                                    <option value="">Select a Clinic</option>
                                    @foreach ($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Clinic Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Clinic Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <!-- Quill editor container -->
                                <div id="description-editor" class="form-control" style="height: 150px;"></div>
                                <input type="hidden" id="description" name="description">
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address" required>
                            </div>
                            <div class="mb-3">
                                <label for="main_image" class="form-label">Main Image</label>
                                <input type="file" class="form-control" id="main_image" name="main_image">
                            </div>
                            <div class="mb-3">
                                <label for="gallery_images" class="form-label">Gallery Images</label>
                                <input type="file" class="form-control" id="gallery_images" name="gallery_images[]" multiple>
                                <div id="gallery-preview" class="mt-2"></div> <!-- Preview selected images -->
                            </div>
                            <div class="mb-3">
                                <label for="map_embed_code" class="form-label">Map Embed Code</label>
                                <textarea class="form-control" id="map_embed_code" name="map_embed_code"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="country_id" class="form-label">Select Country</label>
                                <select class="form-control" id="country_id" name="country_id" required>
                                    <option value="">Select a country</option>
                                    @foreach($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="state_id" class="form-label">Select State</label>
                                <select class="form-control" id="state_id" name="state_id" required>
                                    <!-- States will be loaded dynamically based on selected country -->
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="categories" class="form-label">Select Categories</label>
                                <select id="categories" name="categories[]" multiple="multiple" required>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="subcategories" class="form-label">Select Subcategories</label>
                                <select id="subcategories" name="subcategories[]" multiple="multiple" required>
                                    @foreach($subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>

    <script>

        $('#country_id').on('change', function () {
            var countryId = $(this).val();
            console.log(countryId);
            
            $.ajax({
                url: '/admin/states-by-country/' + countryId,
                type: 'GET',
                success: function (data) {
                    console.log(data);
                    
                    $('#state_id').html(data);
                }
            });
        });

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
            new TomSelect("#user_id");
        });
        document.addEventListener('DOMContentLoaded', function () {
           var quill = new Quill('#description-editor', {
                theme: 'snow'
            });

             // Sync Quill content with the textarea on form submit
             document.querySelector('#submit').onclick = function() {
                document.querySelector('#description').value = quill.root.innerHTML;
            };
        });

        // Initialize Select2 for multi-select dropdowns
        $('.select2').select2();

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

        // Preview selected gallery images
        $('#gallery_images').on('change', function() {
            $('#gallery-preview').html('');
            var files = this.files;
            for (var i = 0; i < files.length; i++) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#gallery-preview').append('<img src="' + e.target.result + '" width="100" class="me-2 mt-2"/>');
                };
                reader.readAsDataURL(files[i]);
            }
        });
      
    </script>
@endsection
