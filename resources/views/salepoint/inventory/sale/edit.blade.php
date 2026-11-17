<x-salepoint>
    @section('title', 'Edit Sale')

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
            <div class="col-md-11 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h5>Edit Sale</h5>
                    </div>

                    <div class="card-body">
                        <div>
                            <div class="row my-2">
                                <div class="col-md-6">
                                    <label for="area" class="form-label">Customer Group</label>
                                    <select id="area" name="area" class="form-select" required>
                                        <option value="">Select Customer Group</option>
                                        @foreach ($areas as $area)
                                            <option value="{{$area->id}}" {{$area->id == $sale->area_id ? 'selected' : ''}}>{{$area->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="customer" class="form-label">Customer</label>
                                    <select id="customer" name="customer" class="form-select" required>
                                        @foreach ($customers as $customer)
                                            <option value="{{$customer->id}}" {{$customer->id == $sale->customer_id ? 'selected' : ''}}>{{$customer->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="category" class="form-label">Supplier</label>
                                    <select id="category" name="category" class="form-select">
                                        @foreach ($brands as $brand)
                                            <option value="{{$brand->id}}">{{$brand->name}}</option>
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
                                <!-- Existing products will be displayed here -->
                                @foreach ($products as $product)
                                    @php
                                        $productDetails = \App\Models\Product::find($product->product);
                                    @endphp
                                    <div class="card mb-3 product-item" data-product-id="{{ $product->product }}">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <input type="text" class="form-control" value="{{ $productDetails->name }}" readonly>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="text" class="form-control" value="Stock: {{ $productDetails->stock }}" readonly>
                                                </div>
                                               
                                                <div class="col-md-2">
                                                    <input type="text" class="form-control quantity" value="{{ $product->quantity }}">
                                                </div>
                                          
                                                <div class="col-md-2 d-none">
                                                    <input type="text" class="form-control product-id" value="{{ $product->product }}" readonly>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="number" class="form-control sale-price" value="{{ $product->salePrice }}" required>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="text" class="form-control amount" value="{{ $product->amount }}" readonly>
                                                </div>
                                                <input type="hidden" class="product-stock" value="{{ $productDetails->stock }}">
                                                <div class="col-md-1 d-flex align-items-center">
                                                    <button type="button" class="btn btn-danger btn-sm delete-btn"><i class="fas fa-trash-alt"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <br>
                            <hr>
                            <h3>Payment Details</h3>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="subtotal" class="form-label">Subtotal</label>
                                    <input type="text" id="subtotal" class="form-control" value="{{ $sale->subtotal }}" readonly>
                                </div>
                                <div class="col-md-2">
                                    <label for="tax" class="form-label">Tax (%)</label>
                                    <input type="number" id="tax" class="form-control" value="{{ $sale->tax }}">
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
                                    <input type="number" id="discount" class="form-control" value="{{ $sale->discount }}">
                                </div>
                                <div class="col-md-2">
                                    <label for="discountType" class="form-label">Discount Type</label>
                                    <select id="discountType" name="discountType" class="form-select">
                                        <option value="percentage" {{ $sale->discount_type == 'percentage' ? 'selected' : '' }}>Percentage</option>
                                        <option value="amount" {{ $sale->discount_type == 'amount' ? 'selected' : '' }}>Amount</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="finalAmount" class="form-label">Final Amount</label>
                                    <input type="text" id="finalAmount" class="form-control" value="{{ $sale->final_amount }}" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="payaccount" class="form-label">Payment Method</label>
                                    <select name="payaccount" id="payaccount" class="form-control">
                                        @foreach ($accounts as $account)
                                            <option value="{{$account->id}}" {{$account->id == $sale->payaccount ? 'selected' : ''}}>{{$account->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="finalAmount" class="form-label">Now Pay Amount</label>
                                    <input type="text" id="nowpay" value="{{ $sale->final_amount -  $sale->remaining_amount}}" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="remaining_amount" class="form-label">Remaining Amount</label>
                                    <input type="text" id="remaining_amount" class="form-control" value="{{ $sale->remaining_amount }}" readonly>
                                </div>
                            </div>
                            @if($sale->has_return)
                            @else
                            <button type="submit" id="updateButton" class="btn btn-success">Update Sale</button>
                            @endif
                           
                            <a href="{{ route('sale_invoice', $sale->id) }}" target="_blank" class="btn btn-success">Print Invoice</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>

    <script>
        
        document.addEventListener('DOMContentLoaded', function () {

// Initialize pay account select with TomSelect
let payAccountSelect = new TomSelect('#payaccount');

// Fetch customers based on the selected area
document.getElementById('area').addEventListener('change', getCustomer);

// Fetch products based on the selected category
document.getElementById('category').addEventListener('change', getProducts);

// Add event listener for adding a product to the list
document.getElementById('addButton').addEventListener('click', addProduct);

// Add event listener for updating totals and amounts on input changes
document.getElementById('productList').addEventListener('input', handleInputChanges);

// Event listener for updating final amount when tax, discount, or payment changes
document.getElementById('tax').addEventListener('input', updateFinalAmount);
document.getElementById('taxType').addEventListener('change', updateFinalAmount);
document.getElementById('discount').addEventListener('input', updateFinalAmount);
document.getElementById('discountType').addEventListener('change', updateFinalAmount);
document.getElementById('nowpay').addEventListener('input', updateFinalAmount);

// Fetch initial customers and products on page load
getCustomer();
getProducts();

// Function to fetch and populate customers based on area
function getCustomer() {
    var area = $('#area').val();
    fetch(`/by-area/${area}`)
        .then(response => response.json())
        .then(data => {
            var customerSelect = document.getElementById('customer');
            customerSelect.innerHTML = '';
            data.forEach(customer => {
                var option = document.createElement('option');
                option.value = customer.id;
                option.text = customer.name;
                customerSelect.appendChild(option);
            });
        })
        .catch(error => console.error('Error fetching customers:', error));
}

// Function to fetch and populate products based on category
function getProducts() {
    var categoryId = $('#category').val();
    fetch(`/stock/salepoint/by-category/${categoryId}`)
        .then(response => response.json())
        .then(data => {
            var productSelect = document.getElementById('product');
            productSelect.innerHTML = '';
            data.forEach(product => {
                var option = document.createElement('option');
                option.value = product.id;
                option.text = product.name;
                option.setAttribute('data-stock', product.stock);
                productSelect.appendChild(option);
            });
        })
        .catch(error => console.error('Error fetching products:', error));
}

// Function to add a product to the product list
function addProduct() {
    const productSelect = document.getElementById('product');
    const productId = productSelect.value;
    const productName = productSelect.options[productSelect.selectedIndex].text;
    const stock = productSelect.options[productSelect.selectedIndex].getAttribute('data-stock');
    const salePrice = productSelect.options[productSelect.selectedIndex].getAttribute('data-sale-price');

    if (productId) {
        const existingProduct = document.querySelector(`.product-item[data-product-id="${productId}"]`);

        if (existingProduct) {
            const quantityInput = existingProduct.querySelector('.quantity');
            quantityInput.value = parseFloat(quantityInput.value) + 1;
            updateTotal(existingProduct);
        } else {
            addNewProductItem(productId, productName, stock, salePrice);
        }

        updateAmounts();
    } else {
        alert('Please select a product');
    }
}

// Function to add a new product item to the product list
function addNewProductItem(productId, productName, stock, salePrice) {
    const productList = document.getElementById('productList');
    const productItem = document.createElement('div');
    productItem.className = 'card mb-3 product-item';
    productItem.setAttribute('data-product-id', productId);
    productItem.innerHTML = `
        <div class="card-body">
            <div class="row">
                <div class="col-md-2">
                    <input type="text" class="form-control" value="${productName}" readonly>
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" value="Stock: ${stock}" readonly>
                </div>
                <div class="col-md-2">
                    <input type="number" class="form-control quantity" value="1" required>
                </div>
                <div class="col-md-2 d-none">
                    <input type="text" class="form-control product-id" value="${productId}" readonly>
                </div>
                <div class="col-md-2">
                    <input type="number" class="form-control sale-price" value="${salePrice}" required>
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control amount" value="${salePrice}" readonly>
                </div>
                <input type="hidden" class="product-stock" value="${stock}">
                <div class="col-md-1 d-flex align-items-center">
                    <button type="button" class="btn btn-danger btn-sm delete-btn"><i class="fas fa-trash-alt"></i></button>
                </div>
            </div>
        </div>
    `;
    productList.appendChild(productItem);
}

// Function to handle input changes in the product list
function handleInputChanges(event) {
    const target = event.target;

    if (target.classList.contains('quantity') || target.classList.contains('sale-price')) {
        const card = target.closest('.product-item');
        updateTotal(card);
    }

    if (target.classList.contains('delete-btn')) {
        const productItem = target.closest('.product-item');
        productItem.remove();
    }

    updateAmounts();
}

// Function to update the total amount for a specific product item
function updateTotal(card) {
    const quantity = parseFloat(card.querySelector('.quantity').value) || 0;
    const salePrice = parseFloat(card.querySelector('.sale-price').value) || 0;
    const amount = quantity * salePrice;
    card.querySelector('.amount').value = amount.toFixed(2);
}

// Function to update the subtotal and final amounts
function updateAmounts() {
    const productItems = document.querySelectorAll('.product-item');
    let subtotal = 0;

    productItems.forEach(item => {
        const amount = parseFloat(item.querySelector('.amount').value) || 0;
        subtotal += amount;
    });

    document.getElementById('subtotal').value = subtotal.toFixed(2);
    updateFinalAmount();
}

// Function to update the final amount considering tax, discount, and payments
function updateFinalAmount() {
    const subtotal = parseFloat(document.getElementById('subtotal').value) || 0;
    const tax = parseFloat(document.getElementById('tax').value) || 0;
    const discount = parseFloat(document.getElementById('discount').value) || 0;
    const taxType = document.getElementById('taxType').value;
    const discountType = document.getElementById('discountType').value;

    let taxAmount = (taxType === 'percentage') ? subtotal * (tax / 100) : tax;
    let discountAmount = (discountType === 'percentage') ? subtotal * (discount / 100) : discount;

    const finalAmount = subtotal + taxAmount - discountAmount;
    document.getElementById('finalAmount').value = finalAmount.toFixed(2);

    const nowPay = parseFloat(document.getElementById('nowpay').value) || 0;
    const remainingAmount = finalAmount - nowPay;
    document.getElementById('remaining_amount').value = remainingAmount.toFixed(2);
}

// Submit updated sale data
document.getElementById('updateButton').addEventListener('click', function (e) {
    e.preventDefault();

    const finalAmount = parseFloat(document.getElementById('finalAmount').value) || 0;
    const nowpay = parseFloat(document.getElementById('nowpay').value) || 0;
    const customer = document.getElementById('customer').value || '';

    if (nowpay < finalAmount && !customer) {
        Swal.fire({
            icon: 'error',
            title: 'Invalid Payment',
            text: 'If you want to sell the rest, you must select the customer.',
        });
        return;
    }

    const productItems = document.querySelectorAll('.product-item');
    const products = Array.from(productItems).map(item => ({
        product: item.querySelector('.product-id').value,
        quantity: parseFloat(item.querySelector('.quantity').value) || 0,
        salePrice: parseFloat(item.querySelector('.sale-price').value) || 0,
        amount: parseFloat(item.querySelector('.amount').value) || 0,
        stock: parseFloat(item.querySelector('.product-stock').value) || 0,
    }));

    const data = {
        products,
        subtotal: parseFloat(document.getElementById('subtotal').value) || 0,
        tax: parseFloat(document.getElementById('tax').value) || 0,
        taxType: document.getElementById('taxType').value,
        discount: parseFloat(document.getElementById('discount').value) || 0,
        discountType: document.getElementById('discountType').value,
        finalAmount: finalAmount,
        customer_id: customer,
        nowpay: nowpay,
        remaining_amount: document.getElementById('remaining_amount').value || null,
        payaccount: document.getElementById('payaccount').value || null,
    };

    fetch('{{ route('salepoint_sale_update', $sale->id) }}', {
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
            window.location.reload();
        } else {
            toastr.error('An error occurred while updating the sale.', 'Error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred: ' + error.message);
    });
});
});

    </script>
</x-salepoint>
