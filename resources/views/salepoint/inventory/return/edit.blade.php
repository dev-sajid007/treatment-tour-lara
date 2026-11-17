<x-salepoint>
    @section('title', 'Add Return')

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
            <div class="col-md-12 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h5>Add Return</h5>
                    </div>

                    <div class="card-body">
                        <div>
                            <div class="row my-2" style="cursor: none;">
                                <div class="col-md-6">
                                    <label for="area" class="form-label">Area</label>
                                    <select id="area" name="area" required @readonly(true)>
                                        @foreach ($areas as $area)
                                            <option value="{{ $area->id }}" {{ $area->id == $sale->area_id ? 'selected' : '' }}>{{ $area->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="customer" class="form-label">Customer</label>
                                    <select id="customer" name="customer" required>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}" {{ $customer->id == $sale->customer_id ? 'selected' : '' }}>{{ $customer->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                           
                            <div class="row mb-3 d-none">
                                <div class="col-md-4">
                                    <label for="category" class="form-label">Category</label>
                                    <select id="category" name="category" class="form-select">
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="product" class="form-label">Product</label>
                                    <select id="product" name="product" class="form-select"></select>
                                </div>
                                <div class="col-md-4 d-flex align-items-end">
                                    <button type="button" id="addButton" class="btn btn-primary w-100">Add</button>
                                </div>
                            </div>
                            <br><hr>
                            <h3>All Added Products</h3>
                            <div id="productList" class="mb-3">
                                <!-- Column labels -->
                                <div class="row mb-3">
                                    <div class="col-md-1"><strong>Select</strong></div>
                                    <div class="col-md-1"><strong>Product ID</strong></div>
                                    <div class="col-md-2"><strong>Product Name</strong></div>
                                    <div class="col-md-2"><strong>Sale Quantity</strong></div>
                                    <div class="col-md-2"><strong>Return Quantity</strong></div>
                                    <div class="col-md-2"><strong>Sale Price</strong></div>
                                    <div class="col-md-2"><strong>Amount</strong></div>
                                </div>
                                <!-- Dynamic product list will appear here -->
                                @foreach ($products as $product)
                                    @php
                                        $productDetails = \App\Models\Product::find($product->product);
                                    @endphp
                                    <div class="row mb-3 product-item">
                                        <div class="col-md-1 d-flex align-items-center">
                                            <input type="checkbox" name="product_ids[]" value="{{ $product->product }}" class="product-checkbox form-check-input" {{ $product->checked ? 'checked' : '' }} style="transform: scale(1.5);">
                                        </div>
                                        <div class="col-md-1 d-flex align-items-center">
                                            <input type="text" class="form-control product-id" value="{{ $productDetails->id }}" readonly>
                                        </div>
                                        <div class="col-md-2 d-flex align-items-center">
                                            <input type="text" class="form-control" value="{{ $productDetails->name }}" readonly>
                                        </div>
                                        <div class="col-md-2 d-flex align-items-center">
                                            <input type="number" id="before_quantity" class="form-control before_quantity" value="{{ $product->saleQuantity ?? 0 }}" placeholder="Sale Quantity" readonly>
                                        </div>
                                        <div class="col-md-2 d-flex align-items-center">
                                            <input type="number" class="form-control quantity" value="{{ $product->quantity ?? 0 }}" placeholder="Return Quantity" required>
                                        </div>
                                        <div class="col-md-2 d-flex align-items-center">
                                            <input type="number" class="form-control sale-price" value="{{ $product->salePrice ?? 0 }}" placeholder="Sale Price" readonly>
                                        </div>
                                        <div class="col-md-2 d-flex align-items-center">
                                            <input type="number" class="form-control amount" value="{{ $product->amount ?? 0 }}" placeholder="Amount" readonly>
                                        </div>
                                        <input type="hidden" class="product-stock" value="{{ $productDetails->stock }}">
                                    </div>
                                @endforeach
                            </div>
                            <br>
                            <hr>
                            <h3>Payment Details</h3>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="subtotal" class="form-label">Subtotal</label>
                                    <input type="text" id="subtotal" class="form-control" readonly>
                                </div>
                                <div class="col-md-2">
                                    <label for="tax" class="form-label">Tax (%)</label>
                                    <input type="number" id="tax" class="form-control" value="{{ $sale->tax }}" readonly>
                                </div>
                                <div class="col-md-2">
                                    <label for="taxType" class="form-label">Tax Type</label>
                                    <select id="taxType" name="taxType" class="form-select">
                                        <option value="percentage" {{ $sale->tax_type == 'percentage' ? 'selected' : '' }}>Percentage</option>
                                        <option value="amount" {{ $sale->tax_type == 'amount' ? 'selected' : '' }}>Amount</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="discount" class="form-label">Discount</label>
                                    <input type="number" id="discount" class="form-control" value="{{ $sale->discount }}" readonly>
                                </div>
                                <div class="col-md-2">
                                    <label for="discountType" class="form-label">Discount Type</label>
                                    <select id="discountType" name="discountType" class="form-select" >
                                        <option value="percentage" {{ $sale->discount_type == 'percentage' ? 'selected' : '' }}>Percentage</option>
                                        <option value="amount" {{ $sale->discount_type == 'amount' ? 'selected' : '' }}>Amount</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="finalAmount" class="form-label">Final Amount</label>
                                    <input type="text" id="finalAmount" class="form-control" readonly>
                                </div>
                                
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="returnAmount" class="form-label">Return Amount</label>
                                    <input type="text" id="returnAmount" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="returnBank" class="form-label">Return Bank</label>
                                    <input type="text" class="form-control" readonly value="{{$accountName}}">
                                </div>
                            </div>
                            <button type="submit" id="updateButton" class="btn btn-success">Update Return</button>       
                            <a href="{{ route('sale_invoice', $sale->id) }}" target="_blank" class="btn btn-success">Print Invoice</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Tom Select for dropdowns
    let areaSelect = new TomSelect('#area');
    let customerSelect = new TomSelect('#customer');
    let categorySelect = new TomSelect('#category');
    let productSelect = new TomSelect('#product');

    const quantities = document.querySelectorAll('.quantity');
    quantities.forEach(input => {
        input.dataset.previousValue = input.value;
    });

    document.getElementById('tax').addEventListener('change', updateAmounts);
    document.getElementById('discount').addEventListener('change', updateAmounts);
    document.getElementById('taxType').addEventListener('change', updateAmounts);
    document.getElementById('discountType').addEventListener('change', updateAmounts);

    document.querySelectorAll('.product-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', updateAmounts);
    });

    updateAmounts(); // Call this function to update the return amount on page load
});

document.addEventListener('input', function(event) {
    if (event.target.classList.contains('quantity')) {
        validateAndCalculate(event.target);
    }
});

function validateAndCalculate(target) {
    const productItem = target.closest('.product-item');
    const quantity = parseFloat(productItem.querySelector('.quantity').value) || 0;
    const saleQuantity = parseFloat(productItem.querySelector('.before_quantity').value) || 0;

    if (quantity > saleQuantity) {
        alert('Return quantity cannot be more than sale quantity.');
        target.value = target.dataset.previousValue; // Reset to previous value
    } else {
        target.dataset.previousValue = target.value; // Update previous value
        updateAmounts();
    }
}

function updateAmounts() {
    const productItems = document.querySelectorAll('.product-item');
    let subtotal = 0;
    let returnAmount = 0;

    productItems.forEach(item => {
        const beforeQuantity = parseFloat(item.querySelector('.before_quantity').value) || 0;
        const quantity = parseFloat(item.querySelector('.quantity').value) || 0;
        const salePrice = parseFloat(item.querySelector('.sale-price').value) || 0;
        const amount = item.querySelector('.amount');
        const checkbox = item.querySelector('.product-checkbox');

        // Calculate the total amount based on before_quantity * sale_price
        const total = beforeQuantity * salePrice;
        amount.value = total.toFixed(2);
        subtotal += total;

        // Calculate the return amount if the checkbox is checked
        if (checkbox.checked) {
            const returnTotal = quantity * salePrice;
            returnAmount += returnTotal;
        }
    });

    const tax = parseFloat(document.getElementById('tax').value) || 0;
    const discount = parseFloat(document.getElementById('discount').value) || 0;
    const taxType = document.getElementById('taxType').value;
    const discountType = document.getElementById('discountType').value;

    let finalAmount = subtotal;

    if (taxType === 'percentage') {
        finalAmount += (subtotal * tax / 100);
    } else {
        finalAmount += tax;
    }

    if (discountType === 'percentage') {
        finalAmount -= (subtotal * discount / 100);
    } else {
        finalAmount -= discount;
    }

    document.getElementById('subtotal').value = subtotal.toFixed(2);
    document.getElementById('finalAmount').value = finalAmount.toFixed(2);
    document.getElementById('returnAmount').value = returnAmount.toFixed(2);
}

document.getElementById('updateButton').addEventListener('click', function (e) {
    e.preventDefault();
        
    const productItems = document.querySelectorAll('.product-item');
    const products = [];

    productItems.forEach(item => {
        const productId = item.querySelector('.product-id').value;
        const quantity = parseFloat(item.querySelector('.quantity').value) || 0;
        const salePrice = parseFloat(item.querySelector('.sale-price').value) || 0;
        const amount = parseFloat(item.querySelector('.amount').value) || 0;
        const before_quantity = parseFloat(item.querySelector('.before_quantity').value) || 0;
        const datbase_add_stock = before_quantity - quantity;
        const checked = item.querySelector('.product-checkbox').checked;

        products.push({
            product: productId,
            quantity,
            salePrice,
            amount,
            before_quantity,
            datbase_add_stock,
            checked
        });
    });

    const data = {
        products,
        subtotal: parseFloat(document.getElementById('subtotal').value) || 0,
        returnAmount: parseFloat(document.getElementById('returnAmount').value) || 0
    };

    fetch('{{ route('salepoint_return_add', $sale->id) }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            toastr.success('Sale updated successfully!', 'Success');
            setTimeout(function() {
                window.location.href = "{{ route('return_add_list') }}";
            }, 2000);
        } else {
            toastr.error('An error occurred while submitting the sale.', 'Error');
        }
    })
    .catch(error => console.error('Error:', error));
});

function closeAlert(button) {
    button.parentElement.parentElement.remove();
}
</script>


</x-salepoint>
