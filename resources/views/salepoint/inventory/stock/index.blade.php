<x-salepoint>
    @section('title', 'Stock Product')

    <div class="container-fluid">
        <form action="{{ route('salepoint_stock') }}" method="GET">
            @csrf
            <div class="row my-3">
                <div class="col-md-3">
                    <label for="category" class="form-label">Category</label>
                    <select id="category" name="category">
                        @foreach ($brands as $brand)
                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="product" class="form-label">Product</label>
                    <select id="product" name="product">
                        <!-- Product options will be populated via JS -->
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="">Action</label>
                    <div class="d-flex">
                        <button type="submit" id="addButton" class="btn btn-primary">Filter</button>
                        <a href="{{ route('salepoint_stock') }}" class="btn btn-danger ms-3">Reset</a>
                    </div>
                </div>
            </div>
        </form>
        <br>
        <div class="col-12">
            <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Brand</th>
                        <th>Godown</th>
                        <th>Total Stock</th>
                        <th>Status</th>
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
                        <td>{{ $product->stock }}</td>
                        <td>
                            @if ($product->stock == 0)
                                <button class="btn btn-danger btn-sm">Un-Available</button>
                            @else
                                <button class="btn btn-primary btn-sm">Available</button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel"></h5>
                    <button type="button" class="close btn btn-danger" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Category:</strong> <span id="modal-category"></span></p>
                    <p><strong>Brand:</strong> <span id="modal-brand"></span></p>
                    <p><strong>Unit:</strong> <span id="modal-unit"></span></p>
                    <p><strong>Godown:</strong> <span id="modal-godown"></span></p>
                    <p><strong>Description:</strong> <span id="modal-description"></span></p>
                    <img id="modal-image" src="" alt="" class="img-fluid">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>

    <!-- Custom Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize Tom Select for category and product select elements
            let categorySelect = new TomSelect('#category');
            let productSelect = new TomSelect('#product');
            
            // Load products based on the selected category
            function getProducts() {
                let categoryId = $('#category').val();
                fetch(`/stock/salepoint/by-category/${categoryId}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        productSelect.clearOptions(); // Clear previous options
                        data.forEach(product => {
                            productSelect.addOption({
                                value: product.id,
                                text: product.name,
                                data: {
                                    stock: product.stock
                                }
                            });
                        });
                        productSelect.refreshOptions();
                    })
                    .catch(error => console.error('There was a problem with the fetch operation:', error));
            }

            // Event listener for category change
            $('#category').change(function() {
                getProducts();
            });

            // Load initial products if category is pre-selected
            getProducts();
        });
    </script>
</x-salepoint>
