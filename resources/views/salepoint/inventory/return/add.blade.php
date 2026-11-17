<x-salepoint>

    @section('title', 'Sale Return List')
    
    <div class="container-fluid">
        <form action="{{ route('salepoint_return_list') }}" method="GET">
            @csrf
            <div class="row my-3">
                <div class="col-md-3">
                    <label for="area">Customer Area</label>
                    <select name="area" id="area">
                        <option value="">Select Area</option>
                        @foreach ($areas as $area)
                            <option value="{{$area->id}}">{{$area->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="customer">Customer name</label>
                    <select name="customer" id="customer">
                        <option value="">Select Customer</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="date">Search By Date</label>
                    <input type="date" name="date" id="date" class="form-control">
                </div>
                <div class="col-md-3">
                    <label for="action">Action</label>
                    <div class="d-flex">
                        <button type="submit" class="btn btn-info">Filter</button>
                        <a href="{{route('return_list')}}" class="btn btn-danger ms-3">Reset</a>
                    </div>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-12">
                <table id="example" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Customer</th>
                            <th>Total Price</th>
                            <th>Return Amount</th>
                            <th>SalePoint</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($salereturs as $sale)
                            <tr>
                                <td>{{ $sale->id }}</td>
                                <td>{{ $sale->sale->customer->name }}</td>
                                <td>{{$settings->currency}}{{ $sale->subtotal }}</td>
                                <td>{{$settings->currency}}{{ $sale->returnAmount }}</td>
                                <td>{{ optional($sale->creator)->name }}</td>
                                <td>{{ $sale->created_at->format('d-M-Y') }}</td>
                                <td>
                                    <a href="{{ route('salepoint_sale_edit', $sale->sale_id) }}" target="_" class="btn btn-warning edit-btn"><i class="fas fa-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let areaSelect = new TomSelect('#area');
            let customerSelect = new TomSelect('#customer');
    
            // Load customers based on selected area
            document.getElementById('area').addEventListener('change', function() {
                var area = this.value;
                var xhr = new XMLHttpRequest();
                xhr.open('GET', `/by-area/${area}`, true);
                xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    
                xhr.onload = function() {
                    if (xhr.status >= 200 && xhr.status < 400) {
                        var response = JSON.parse(xhr.responseText);
                        customerSelect.clearOptions();
    
                        response.forEach(function(customer) {
                            customerSelect.addOption({ value: customer.id, text: customer.name });
                        });
                        customerSelect.refreshOptions(false);
                    } else {
                        console.error('Error: ', xhr.statusText);
                    }
                };
    
                xhr.onerror = function() {
                    console.error('Request failed');
                };
    
                xhr.send();
            });
    
            // Load initial customers if area is pre-selected
            getCustomer();
        });
    
        function getCustomer() {
            var area = document.getElementById('area').value;
            if (area) {
                var xhr = new XMLHttpRequest();
                xhr.open('GET', `/sale/by-area/${area}`, true);
                xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    
                xhr.onload = function() {
                    if (xhr.status >= 200 && xhr.status < 400) {
                        var response = JSON.parse(xhr.responseText);
                        let customerSelect = new TomSelect('#customer');
                        customerSelect.clearOptions();
    
                        response.forEach(function(customer) {
                            customerSelect.addOption({ value: customer.id, text: customer.name });
                        });
                        customerSelect.refreshOptions(false);
                    } else {
                        console.error('Error: ', xhr.statusText);
                    }
                };
    
                xhr.onerror = function() {
                    console.error('Request failed');
                };
    
                xhr.send();
            }
        }
    </script>
    
    </x-salepoint>
    