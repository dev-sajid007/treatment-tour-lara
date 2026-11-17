<x-salepoint>
    @section('title', 'Purchase List')
    
    <div class="container-fluid">
        <form method="GET" action="{{ route('salepoint_purchase_index') }}">
            <div class="row my-3">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="category">Select Brand</label>
                        <select id="category" name="category">
                            <option value="">Select a Brand</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" {{ request()->category == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="product">Select Product</label>
                        <select id="product" name="product">
                            <option value="">Select a Product</option>
                            @if (request()->category)
                                @foreach ($products as $product)
                                    @if ($product->brand_id == request()->category)
                                        <option value="{{ $product->id }}" {{ request()->product == $product->id ? 'selected' : '' }}>
                                            {{ $product->name }}
                                        </option>
                                    @endif
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="date">Select Day</label>
                        <input type="date" class="form-control" name="date" id="date" value="{{ request()->date }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="">&nbsp;</label>
                    <br>
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('salepoint_purchase_index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>        
        <br>
        <div class="row">
            <div class="col-12">
                <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Brand</th>
                            <th>Product</th>
                            <th>Total Item</th>
                            <th>Buy Price</th>
                            <th>Sale Price</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($purchases as $purchase)
                        <tr>
                            <td>{{ $purchase->id }}</td>
                            <td>{{ optional($purchase->brand)->name }}</td>
                            <td>{{ optional($purchase->product)->name }}</td>
                            <td>{{ $purchase->total_item }}</td>
                            <td>{{ $purchase->buy_price }}</td>
                            <td>{{ $purchase->sale_price }}</td>
                            <td>
                                <a href="{{ route('salepoint_purchase_edit', $purchase->id) }}" class="btn btn-warning edit-btn"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('salepoint_purchase_destroy', $purchase->id) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger delete-btn"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Tom Select for the category and product dropdowns
            let categorySelect = new TomSelect('#category');
            let productSelect = new TomSelect('#product');
            
            // Handle delete button click
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
    
            document.getElementById('category').addEventListener('change', function() {
                getProducts();
            });
    
            function getProducts(){
                var categoryId = $('#category').val();
                fetch(`/salepoint_purchase/by-category/${categoryId}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        productSelect.clearOptions(); // Clear existing options
                        
                        // Add an empty "Select a product" option
                        productSelect.addOption({value: '', text: 'Select a product'});
    
                        data.forEach(product => {
                            productSelect.addOption({value: product.id, text: product.name});
                        });
                        
                        productSelect.refreshOptions(false); // Refresh without clearing the input
                    })
                    .catch(error => console.error('There was a problem with the fetch operation:', error));
            }
    
            if (document.getElementById('category').value) {
                getProducts();
            }
        });
    </script>
</x-salepoint>
