<x-salepoint>
    @section('title', 'Add Purchase')
    
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
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="iq-alert-text">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <button type="button" data-dismiss="alert" class="close btn btn-danger ms-4" aria-label="Close" onclick="closeAlert(this)">
                            X
                        </button>
                    </div>
                </div>
                @endif
            </div>            
        </div>
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h5>Add Purchase</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('salepoint_add_purchase_store') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="category">Brand</label>
                                    <select name="brand" id="category">
                                        <option value="">Select a Brand</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="product">Product</label>
                                    <select name="product" id="product" >
                                        <!-- Products will be populated here based on category selection -->
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row my-4">
                                <div class="col-md-6">
                                    <label for="total_item">Total Item</label>
                                    <input type="number" id="total_item" name="total_item" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="buy_price">Buy Price (Per Item)</label>
                                    <input type="number" id="buy_price" name="buy_price" class="form-control">
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <label for="sale_price">Set Sale Price (Per Item)</label>
                                    <input type="number" id="sale_price" name="sale_price" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="total_ammount">Total Amount</label>
                                    <input type="number" id="total_ammount" name="total_ammount" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <label for="deposit_amount">Deposit Amount</label>
                                    <input type="number" id="deposit_amount" name="deposit_amount" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="due_ammount">Due Amount</label>
                                    <input type="number" id="due_ammount" name="due_ammount" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <label for="bank">Payment Method</label>
                                    <select name="bank" id="bank" class="form-control">
                                        @foreach ($banks as $bank)
                                            <option value="{{$bank->id}}">{{$bank->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <br><br>
                            <div class="form-group">
                                <input type="submit" value="Add Product" class="btn btn-outline-success">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <script>
    document.addEventListener('DOMContentLoaded', function () {
    // Initialize Tom Select for category and product
    let categorySelect = new TomSelect('#category');
    let productSelect = new TomSelect('#product');
    
    document.getElementById('category').addEventListener('change', function() {
        getProducts();
    });

    function getProducts() {
        var categoryId = $('#category').val();
        fetch(`/salepoint_purchase/by-category/${categoryId}`)
            .then(response => response.json())
            .then(data => {
                productSelect.clearOptions(); // Clear existing options
                
                data.forEach(product => {
                    productSelect.addOption({ value: product.id, text: product.name });
                });
                
                productSelect.refreshOptions(false); // Refresh options without clearing the input
            })
            .catch(error => console.error('There was a problem with the fetch operation:', error));
    }

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
        document.getElementById('due_ammount').value = dueAmount.toFixed(2);
    }

    updateAmounts(); // Initialize the amounts on page load
});

function closeAlert(button) {
    button.parentElement.parentElement.remove();
}

    </script>

</x-salepoint>
