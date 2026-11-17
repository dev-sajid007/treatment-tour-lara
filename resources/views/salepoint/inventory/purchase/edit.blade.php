<x-salepoint>
    @section('title', 'Edit Purchase')

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
                        <h5>Edit Purchase</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('salepoint_purchase_update', $purchase->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="category">Brand</label>
                                    <select name="brand_id" id="category">
                                        @foreach ($brands as $brand)
                                            <option value="{{$brand->id}}" {{ old('brand_id', $purchase->brand_id) == $brand->id ? 'selected' : '' }}>{{$brand->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="product">Product</label>
                                    <select name="product_id" id="product">
                                        @foreach ($products as $product)
                                            <option value="{{$product->id}}" {{ old('product_id', $purchase->product_id) == $product->id ? 'selected' : '' }}>{{$product->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row my-4">
                                <div class="col-md-6">
                                    <label for="total_item">Total Item</label>
                                    <input type="number" id="total_item" name="total_item" class="form-control" value="{{ old('total_item', $purchase->total_item) }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="buy_price">Buy Price (Per Item)</label>
                                    <input type="number" id="buy_price" name="buy_price" class="form-control" value="{{ old('buy_price', $purchase->buy_price) }}">
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <label for="sale_price">Set Sale Price (Per Item)</label>
                                    <input type="number" id="sale_price" name="sale_price" class="form-control" value="{{ old('sale_price', $purchase->sale_price) }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="total_ammount">Total Amount</label>
                                    <input type="number" id="total_ammount" name="total_ammount" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <label for="deposit_amount">Deposit Amount</label>
                                    <input type="number" id="deposit_amount" name="deposit_amount" class="form-control" value="{{ old('deposit_amount', $purchase->deposit_amount) }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="due_amount">Due Amount</label>
                                    <input type="number" id="due_amount" name="due_amount" class="form-control" value="{{ old('due_amount', $purchase->due_amount) }}" readonly >
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <label for="bank">Payment Method</label>
                                    <select name="bank" id="bank" >
                                        @foreach ($banks as $bank)
                                            <option value="{{$bank->id}}" {{ old('bank', $purchase->bank_id) == $bank->id ? 'selected' : '' }}>{{$bank->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                             <br><br>
                            <div class="form-group">
                                <input type="submit" value="Update Purchase" class="btn btn-outline-success">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let categorySelect = new TomSelect('#category');
            let productSelect = new TomSelect('#product');
            let bankSelect = new TomSelect('#bank');
            
            document.getElementById('category').addEventListener('change', function() {
                getProducts();
            });

            function getProducts() {
                var brandId = $('#category').val();
                fetch(`/salepoint_purchase/by-category/${brandId}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        productSelect.clearOptions(); // Clear existing options

                        data.forEach(product => {
                            productSelect.addOption({ value: product.id, text: product.name });
                        });

                        productSelect.refreshOptions(false); // Refresh options without clearing the input
                    })
                    .catch(error => console.error('There was a problem with the fetch operation:', error));
            }

            document.getElementById('buy_price').addEventListener('input', updateTotalAmount);
            document.getElementById('total_item').addEventListener('input', updateTotalAmount);

            function updateTotalAmount() {
                var buyPrice = parseFloat(document.getElementById('buy_price').value) || 0;
                var totalItems = parseInt(document.getElementById('total_item').value) || 0;
                var totalAmount = buyPrice * totalItems;
                document.getElementById('total_ammount').value = totalAmount.toFixed(2);
            }

            updateTotalAmount(); // Initialize the total amount on page load
        });


            // Calculate and update total amount and due amount
        document.getElementById('buy_price').addEventListener('input', updateAmounts);
        document.getElementById('total_item').addEventListener('input', updateAmounts);
        document.getElementById('deposit_amount').addEventListener('input', updateAmounts);

        function updateAmounts() {
            var buyPrice = parseFloat(document.getElementById('buy_price').value) || 0;
            var totalItems = parseInt(document.getElementById('total_item').value) || 0;
            var depositAmount = parseFloat(document.getElementById('deposit_amount').value) || 0;

            var totalAmount = buyPrice * totalItems;
            var dueAmount = totalAmount - depositAmount;

            document.getElementById('total_ammount').value = totalAmount.toFixed(2);
            document.getElementById('due_amount').value = dueAmount.toFixed(2);
        }




        function closeAlert(button) {
            button.parentElement.parentElement.remove();
        }
    </script>
</x-salepoint>
