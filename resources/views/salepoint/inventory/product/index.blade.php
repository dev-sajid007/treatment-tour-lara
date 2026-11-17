<x-salepoint>
    @section('title', 'Product List')
    
    <div class="container-fluid">
        <!-- Start page title -->
        <form action="{{ route('salepoint_products_index') }}" method="GET">
            @csrf
            <div class="row my-4">
                <div class="col-md-4">
                    <label for="category" class="form-label">Category</label>
                    <select id="category" name="category" >
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="brand" class="form-label">Brand</label>
                    <select id="brand" name="brand" >
                        <option value="">Select Brand</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}" {{ request('brand') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="action" class="form-label">Action</label><br>
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('salepoint_products_index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>
    
        <div class="row">
            <div class="col-12">
                <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Brand</th>
                            <th>Godown</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ optional($product->category)->name }}</td>
                                <td>{{ optional($product->brand)->name }}</td>
                                <td>{{ optional($product->godown)->name }}</td>
                                <td>
                                    @if ($product->image)
                                        <img src="{{ asset('storage/img/' . $product->image) }}" alt="{{ $product->name }}" width="50">
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('salepoint_product_edit', $product->id) }}" class="btn btn-warning edit-btn"><i class="fas fa-edit"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize Tom Select for the category and brand dropdowns
            new TomSelect('#category');
            new TomSelect('#brand');

            $(document).on('click', '.delete-btn', function() {
                var form = $(this).closest('.delete-form');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
</x-salepoint>
