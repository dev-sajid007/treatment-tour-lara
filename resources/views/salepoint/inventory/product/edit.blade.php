<x-salepoint>
    <!-- Wrapper Start -->
    @section('title', 'Edit Product')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10 mx-auto">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Edit Product</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                        <div class="alert text-white bg-danger" role="alert">
                            @foreach ($errors->all() as $error)
                            <div class="iq-alert-text">{{ $error }}</div>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="ri-close-line"></i>
                            </button>
                            @endforeach
                        </div>
                        @endif
                        <form action="{{ route('salepoint_products.update', $products->id) }}" method="post" id="editProductForm" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $products->name) }}">
                                        @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div> <br>
                                    <div class="form-group">
                                        <label for="category">Category</label>
                                        <select id="category" name="category_id">
                                            @foreach($categorys as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id', $products->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div> <br>
                                    <div class="form-group">
                                        <label for="brand">Brand</label>
                                        <select id="brand" name="brand_id">
                                            @foreach($brands as $brand)
                                            <option value="{{ $brand->id }}" {{ old('brand_id', $products->brand_id) == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('brand_id')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div> <br>
                                    <div class="form-group">
                                        <label for="unit">Unit</label>
                                        <select id="unit" name="unit_id">
                                            @foreach($units as $unit)
                                            <option value="{{ $unit->id }}" {{ old('unit_id', $products->unit_id) == $unit->id ? 'selected' : '' }}>{{ $unit->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('unit_id')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div> <br>
                                    <div class="form-group">
                                        <label for="godown">Godown</label>
                                        <select id="godown" name="godown_id">
                                            @foreach($godowns as $godown)
                                            <option value="{{ $godown->id }}" {{ old('godown_id', $products->godown_id) == $godown->id ? 'selected' : '' }}>{{ $godown->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('godown_id')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div> <br>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <div id="editor-container" style="height: 150px;"></div>
                                        <textarea class="form-control" id="myTextarea" name="description" style="display:none;">{{ old('description', $products->description) }}</textarea>
                                        @error('description')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div> <br>
                                    <div class="form-group">
                                        <label for="image">Image</label><br>
                                        <input type="file" class="form-control" id="image" name="image">
                                        @error('image')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <br><br>
                                        <img src="{{ asset('storage/img/' . $products->image) }}" alt="" width="150px">
                                    </div>
                                </div>
                            </div> <br>
                            <div class="form-group">
                                <button type="submit" id="updateproduct" class="btn btn-primary">Update Product</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Wrapper End-->

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var quill = new Quill('#editor-container', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        [{ 'header': [1, 2, false] }],
                        ['bold', 'italic', 'underline'],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        ['link', 'image']
                    ]
                }
            });

            // Set the initial content of the Quill editor
            quill.root.innerHTML = {!! json_encode(old('description', $products->description)) !!};

            // Sync Quill content with the textarea on form submit
            document.getElementById('updateproduct').addEventListener('click', function() {
                document.getElementById('myTextarea').value = quill.root.innerHTML;
            });

            // Initialize Tom Select
            new TomSelect('#category', { create: false });
            new TomSelect('#brand', { create: false });
            new TomSelect('#unit', { create: false });
            new TomSelect('#godown', { create: false });
        });

        function closeAlert(button) {
            button.parentElement.parentElement.remove();
        }
    </script>
</x-salepoint>
