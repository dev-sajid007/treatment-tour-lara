<x-salepoint>
    @section('title', 'Add Product')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 mx-auto">
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
            <div class="col-md-10 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h5>Add Product</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('salepoint_add_product_store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name">Product Name</label>
                                    <input type="text" placeholder="Category Name" id="name" name="name" value="{{ old('name') }}" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="category">Category</label>
                                    <select name="category" id="category" >
                                        @foreach ($categorys as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row my-4">
                                <div class="col-md-6">
                                    <label for="brand">Brand</label>
                                    <select name="brand" id="brand" >
                                        @foreach ($brands as $brand)
                                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="godown">Set Godown</label>
                                    <select name="godown" id="godown" >
                                        @foreach ($godowns as $godown)
                                            <option value="{{$godown->id}}">{{$godown->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="unit">Set Unit</label>
                                    <select name="unit" id="unit" >
                                        @foreach ($units as $unit)
                                            <option value="{{$unit->id}}">{{$unit->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="image">Image (Optional)</label>
                                    <input type="file" id="image" name="image" class="form-control">
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-12 mb-5">
                                    <label for="myTextarea">Description</label>
                                    <div id="editor-container"></div>
                                    <textarea id="myTextarea" name="description" style="display:none;">{{ old('description') }}</textarea>
                                </div>
                            </div>
                            <div class="form-group mt-5">
                                <input type="submit" value="Add Product" id="submitproduct" class="btn btn-outline-success">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var quill = new Quill('#editor-container', {
                theme: 'snow'
            });

            // Sync Quill content with the textarea on form submit
            $('#submitproduct').click(function() {
                document.querySelector('#myTextarea').value = quill.root.innerHTML;
            });

            // Initialize Tom Select for the select elements
            new TomSelect('#category');
            new TomSelect('#brand');
            new TomSelect('#godown');
            new TomSelect('#unit');
        });

        function closeAlert(button) {
            button.parentElement.parentElement.remove();
        }
    </script>
</x-salepoint>
