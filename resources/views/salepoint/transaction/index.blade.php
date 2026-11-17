<x-salepoint>
    <!-- Wrapper Start -->
    @section('title', 'All Transaction')
    <style>
        .tooltip-inner {
            font-size: 16px !important;
            max-width: 350px !important;
        }
    </style>
    <div class="wrapper">
        <div class="content-page">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-10 mx-auto">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">All Transaction</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                @if(session('success'))
                                    <div class="alert text-white bg-success" role="alert">
                                        <div class="iq-success-text">{{ session('success') }}</div>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <i class="ri-close-line"></i>
                                        </button>
                                    </div>
                                @endif
                                <br>
                                <form action="{{ route('salepoint_transaction_list') }}" method="GET">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="date">Select Date</label>
                                                <input type="date" class="form-control" id="date" name="date" value="{{ request('date') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="area">Customer Area</label>
                                                <select name="area" id="area">
                                                    <option value="">Select Area</option>
                                                    @foreach ($areas as $area)
                                                        <option value="{{$area->id}}" {{ request('area') == $area->id ? 'selected' : '' }}>{{$area->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="customer">Customer Name</label>
                                                <select name="customer" id="customer">
                                                    <option value="">Select Customer</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="">Action</label>
                                            <br>
                                            <button type="submit" class="btn btn-primary">Filter</button>
                                            <a type="button" class="btn btn-secondary" href="{{ route('transaction_list') }}">Reset</a>
                                        </div>
                                    </div>
                                </form>
                                <br>
                                <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Details</th>
                                            <th>Amount</th>
                                            <th>Account</th>
                                            <th>Type</th>
                                            <th>SalePoint</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transactions as $transaction)
                                            <tr>
                                                <td>{{ $transaction->id }}</td>
                                                <td>{{ $transaction->details }}</td>
                                                <td>{{$settings->currency}}{{ $transaction->amount }}</td>
                                                <td>{{ $transaction->account->name }}</td>
                                                <td>{{ $transaction->type }}</td>
                                                <td>{{ optional($transaction->creator)->name }}</td>
                                                <td>{{ $transaction->created_at->format('d-M-Y') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            // Initialize Tom Select on the area and customer selects
            new TomSelect('#area');
            const customerSelect = new TomSelect('#customer');
    
            getCustomer();
    
            // Retain the selected customer after the page reload
            var selectedCustomer = "{{ request('customer') }}";
            if (selectedCustomer) {
                customerSelect.setValue(selectedCustomer);
            }
    
            $('#area').on('change', function() {
                getCustomer();
            });
    
            function getCustomer() {
                var area = $('#area').val();
                console.log('Selected area:', area); // Debugging step
                if (area) {
                    fetch(`/sale/salepoint/by-area/${area}`)
                        .then(response => response.json())
                        .then(data => {
                            console.log('Fetched data:', data); // Debugging step
                            customerSelect.clearOptions();
                            customerSelect.addOption({ value: '', text: 'Select Customer' });
                            data.forEach(customer => {
                                customerSelect.addOption({ value: customer.id, text: customer.name });
                            });
                            if (selectedCustomer) {
                                customerSelect.setValue(selectedCustomer);
                            }
                            customerSelect.refreshOptions(); // Ensure options are updated in the UI
                        })
                        .catch(error => {
                            console.error('Error fetching customers:', error);
                            alert('An error occurred while fetching customers. Please try again.');
                        });
                } else {
                    customerSelect.clearOptions();
                    customerSelect.addOption({ value: '', text: 'Select Customer' });
                }
            }
        });
    </script>
    
</x-salepoint>
