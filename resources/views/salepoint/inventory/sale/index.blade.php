<x-salepoint>
    @section('title', 'Sale List')

    <div class="container-fluid">
        <form action="{{ route('salepoint_sale_index') }}" method="GET">
            @csrf
            <div class="row my-3">
                <div class="col-md-3">
                    <label for="area">Customer Group</label>
                    <select name="area" id="area" >
                        <option value="">Select Group</option>
                        @foreach ($areas as $area)
                            <option value="{{ $area->id }}" {{ request('area') == $area->id ? 'selected' : '' }}>
                                {{ $area->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="customer">Customer name</label>
                    <select name="customer" id="customer">
                        <option value="">Select Customer</option>
                        <!-- Customer options will be populated by JS -->
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="date">Search By Date</label>
                    <input type="date" name="date" id="date" class="form-control" value="{{ request('date') }}">
                </div>
                <div class="col-md-3">
                    <label for="action">Action</label>
                    <div class="d-flex">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <a href="{{ route('salepoint_sale_index') }}" class="btn btn-secondary ms-3">Reset</a>
                    </div>
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
                            <th>Customer</th>
                            <th>Tax</th>
                            <th>Discount</th>
                            <th>Subtotal</th>
                            <th>Final Amount</th>
                            <th>Saler</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sales as $sale)
                        <tr>
                            <td>{{ $sale->id }}</td>
                            <td>{{ optional($sale->customer)->name }}</td>
                            <td>{{ $sale->tax }}</td>
                            <td>{{ $sale->discount }}</td>
                            <td>{{ $sale->subtotal }}</td>
                            <td>{{ $sale->final_amount }}</td>
                            <td>{{ optional($sale->creator)->name }}</td>
                            <td>
                                @if($sale->has_return)
                                    <button class="btn btn-info" disabled data-toggle="tooltip" title="This Sale is a Return">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                @else
                                    <a href="{{ route('salepoint_sale_edit', $sale->id) }}" class="btn btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                @endif
                                <a href="{{ route('salepoint_sale_invoice', $sale->id) }}" class="btn btn-success" target="_blank"><i class="fas fa-print"></i></a>
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
        $(document).ready(function() {
            // Initialize Tom Select for area and customer select boxes
            const areaSelect = new TomSelect('#area');
            const customerSelect = new TomSelect('#customer');

            // Fetch customers when area is selected
            $('#area').on('change', function() {
                getCustomer();
            });

            function getCustomer() {
                var area = $('#area').val();
                fetch(`/by-area/${area}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        $('#area').html(''); // Clear HTML
                        customerSelect.clearOptions(); // Clear existing options
                        customerSelect.addOption({ value: '', text: 'Select Customer' }); // Add default option

                        data.forEach(customer => {
                            customerSelect.addOption({ value: customer.id, text: customer.name });
                        });

                        // Set the selected value if it exists
                        var selectedCustomer = "{{ request('customer') }}";
                        if (selectedCustomer) {
                            customerSelect.setValue(selectedCustomer);
                        }

                        customerSelect.refreshOptions(); // Refresh Tom Select to update the UI
                    })
                    .catch(error => console.error('There was a problem with the fetch operation:', error));
            }

            // Load customers on page load if area is selected
            if ($('#area').val()) {
                getCustomer();
            }
        });
    </script>

</x-salepoint>
