<x-salepoint>
    @section('title', 'Add Sale')

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
                        <h5>Add Sale</h5>
                    </div>

                    <div class="card-body">
                        <div>
                            <div class="row my-2">
                                <div class="col-md-6">
                                    <label for="area" class="form-label">Customer Group</label>
                                    <select id="area" name="area" required>
                                        <option value="">Select Customer Group</option>
                                        @foreach ($areas as $area)
                                            <option value="{{$area->id}}">{{$area->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="customer" class="form-label">Customer</label>
                                    <select id="customer" name="customer" required></select>
                                </div>
                            </div>
                            <hr>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="category" class="form-label">Supplier</label>
                                    <select id="category" name="category">
                                        @foreach ($brands as $brand)
                                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="product" class="form-label">Product</label>
                                    <select id="product" name="product"></select>
                                </div>
                                <div class="col-md-4 d-flex align-items-end">
                                    <button type="button" id="addButton" class="btn btn-primary w-100">Add</button>
                                </div>
                            </div>
                            <br><hr>
                            <h3>All Added Products</h3>
                            <div id="productList" class="mb-3">
                                <!-- Dynamic product list will appear here -->
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
                                    <input type="number" id="tax" class="form-control">
                                </div>
                                <div class="col-md-2">
                                    <label for="taxType" class="form-label">Tax Type</label>
                                    <select id="taxType" name="taxType" class="form-select">
                                        <option value="percentage">Percentage</option>
                                        <option value="amount">Amount</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label for="discount" class="form-label">Discount</label>
                                    <input type="number" id="discount" class="form-control">
                                </div>
                                <div class="col-md-2">
                                    <label for="discountType" class="form-label">Discount Type</label>
                                    <select id="discountType" name="discountType" class="form-select">
                                        <option value="percentage">Percentage</option>
                                        <option value="amount">Amount</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="finalAmount" class="form-label">Final Amount</label>
                                    <input type="text" id="finalAmount" class="form-control" readonly>
                                </div>
                                <div class="col-md-4">
                                    <label for="payaccount" class="form-label">Payment Method</label>
                                    <select name="payaccount" id="payaccount">
                                        @foreach ($accounts as $account)
                                            <option value="{{$account->id}}">{{$account->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="finalAmount" class="form-label">Now Pay Amount</label>
                                    <input type="text" id="nowpay" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="remaining_amount" class="form-label">Remaining Amount</label>
                                    <input type="text" id="remaining_amount" class="form-control" readonly>
                                </div>
                            </div>
                            <button type="submit" id="saleForm" class="btn btn-success">Submit Sales</button>
                            <a href="" target="_blank" id="printInvoiceLink" class="btn btn-success d-none">Print Invoice</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script>
    $(document).ready(function() {
    // Initialize Tom Select for all select elements
    let areaSelect = new TomSelect('#area');
    let customerSelect = new TomSelect('#customer');
    let categorySelect = new TomSelect('#category');
    let productSelect = new TomSelect('#product');
    let payAccountSelect = new TomSelect('#payaccount');

    // Load initial customers if area is pre-selected
    getCustomer(); 

    // Load initial products if category is pre-selected
    getProducts(); 

    // Event listener for area change
    $('#area').change(function() {
        getCustomer();
    });

    // Event listener for category change
    $('#category').change(function() {
        getProducts();
    });

    function getCustomer() {
        let area = $('#area').val();
        $.ajax({
            url: `/by-area/${area}`,
            type: 'GET',
            success: function(data) {
                $('#customer').html(''); // Clear HTML
                customerSelect.clearOptions(); // Clear Tom Select options
                $.each(data, function(index, customer) {
                    customerSelect.addOption({ value: customer.id, text: customer.name });
                });
                customerSelect.refreshOptions();
            },
            error: function(error) {
                console.error('Error fetching customers:', error);
            }
        });
    }

    function getProducts() {
        let categoryId = $('#category').val();
        $.ajax({
            url: `/stock/salepoint/by-category/${categoryId}`,
            type: 'GET',
            success: function(data) {
                $('#product').html(''); // Clear HTML
                productSelect.clearOptions(); // Clear Tom Select options
                $.each(data, function(index, product) {
                    productSelect.addOption({
                        value: product.id,
                        text: product.name,
                        data: {
                            stock: product.stock
                        }
                    });
                });
                productSelect.refreshOptions();
            },
            error: function(error) {
                console.error('Error fetching products:', error);
            }
        });
    }

    $('#addButton').click(function() {
        const productSelect = document.getElementById('product');
        const productId = productSelect.value;
        const product = productSelect.options[productSelect.selectedIndex].text;
        const stock = productSelect.tomselect.options[productId].data.stock; // Retrieve stock value

        if ($('#category').val() && productId) {
            const existingProduct = $(`.product-id[value="${productId}"]`);
            if (existingProduct.length > 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Duplicate Product',
                    text: 'This product has already been added.'
                });
                return;
            }

            $.ajax({
                url: `/sale/salepoint/product-info/${productId}`,
                type: 'GET',
                success: function(data) {
                    const salePrice = data.sale_price;

                    const productItem = `
                        <div class="card mb-3 product-item">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" value="${product}" readonly>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control" value="Stock: ${stock}" readonly>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" class="form-control quantity" placeholder="Quantity" required>
                                    </div>
                                    <div class="col-md-2 d-none">
                                        <input type="text" class="form-control product-id" value="${productId}" readonly>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" class="form-control sale-price" value="${salePrice}" placeholder="Sale Price" required>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" class="form-control amount" placeholder="Amount" readonly>
                                    </div>
                                    <input type="hidden" class="product-stock" value="${stock}">
                                    <div class="col-md-1 d-flex align-items-center">
                                        <button type="button" class="btn btn-danger btn-sm delete-btn"><i class="fas fa-trash-alt"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    $('#productList').append(productItem);
                    productSelect.tomselect.clear(); // Clear Tom Select after adding product
                },
                error: function(error) {
                    console.error('Error fetching product info:', error);
                }
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Missing Information',
                text: 'Please select both category and product.'
            });
        }
    });

    $('#productList').on('input', '.quantity', function() {
        const card = $(this).closest('.card');
        const quantity = parseFloat(card.find('.quantity').val()) || 0;
        const stock = parseFloat(card.find('.product-stock').val()) || 0;

        if (quantity > stock) {
            Swal.fire({
                icon: 'error',
                title: 'Stock Exceeded',
                text: 'The quantity entered exceeds the available stock.'
            });
            $(this).val(stock);
        }

        updateTotal(card);
        updateAmounts();
    });

    $('#productList').on('click', '.delete-btn', function() {
        $(this).closest('.card').remove();
        updateAmounts();
    });

    $('#tax, #taxType, #discount, #discountType, #nowpay').on('input change', function() {
        updateFinalAmount();
    });

    function updateTotal(card) {
        const quantity = parseFloat(card.find('.quantity').val()) || 0;
        const salePrice = parseFloat(card.find('.sale-price').val()) || 0;
        const amount = quantity * salePrice;
        card.find('.amount').val(amount.toFixed(2));
    }

    function updateAmounts() {
        let subtotal = 0;
        $('.product-item').each(function() {
            subtotal += parseFloat($(this).find('.amount').val()) || 0;
        });
        $('#subtotal').val(subtotal.toFixed(2));
        updateFinalAmount();
    }

    function updateFinalAmount() {
        const subtotal = parseFloat($('#subtotal').val()) || 0;
        const tax = parseFloat($('#tax').val()) || 0;
        const discount = parseFloat($('#discount').val()) || 0;
        const taxType = $('#taxType').val();
        const discountType = $('#discountType').val();

        let taxAmount = taxType === 'percentage' ? subtotal * (tax / 100) : tax;
        let discountAmount = discountType === 'percentage' ? subtotal * (discount / 100) : discount;

        const finalAmount = subtotal + taxAmount - discountAmount;
        $('#finalAmount').val(finalAmount.toFixed(2));

        const nowpay = parseFloat($('#nowpay').val()) || 0;
        const remainingAmount = finalAmount - nowpay;
        $('#remaining_amount').val(remainingAmount.toFixed(2));
    }

    $('#saleForm').click(function(e) {
        e.preventDefault();
        const finalAmount = parseFloat($('#finalAmount').val()) || 0;
        const nowpay = parseFloat($('#nowpay').val()) || 0;
        const customer = $('#customer').val();

        if (nowpay < finalAmount && !customer) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid Payment',
                text: 'If you want to sell the rest then you must select the customer.',
            });
            return;
        }

        const products = [];
        $('.product-item').each(function() {
            products.push({
                product: $(this).find('.product-id').val(),
                quantity: parseFloat($(this).find('.quantity').val()) || 0,
                salePrice: parseFloat($(this).find('.sale-price').val()) || 0,
                amount: parseFloat($(this).find('.amount').val()) || 0,
                stock: parseFloat($(this).find('.product-stock').val()) || 0,
            });
        });

        const data = {
            products: products,
            subtotal: parseFloat($('#subtotal').val()) || 0,
            tax: parseFloat($('#tax').val()) || 0,
            taxType: $('#taxType').val(),
            discount: parseFloat($('#discount').val()) || 0,
            discountType: $('#discountType').val(),
            finalAmount: parseFloat($('#finalAmount').val()) || 0,
            customer_id: customer || null,
            nowpay: $('#nowpay').val() || null,
            remaining_amount: $('#remaining_amount').val() || null,
            payaccount: $('#payaccount').val() || null,
        };

        $.ajax({
            url: '{{ route('salepoint_add_sale_store') }}',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(data),
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    var printInvoiceUrl = window.location.origin + '/sale/salepoint/sales/' + response.sale_id + '/invoice';
                    window.open(printInvoiceUrl, '_blank');
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Sales submitted successfully!'
                    });
                    window.location.reload();
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while submitting the sale.'
                    });
                }
            },
            error: function(error) {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred: ' + error.message
                });
            }
        });
    });

    function closeAlert(button) {
        $(button).closest('.alert').remove();
    }
});

    </script>
</x-layouts>
