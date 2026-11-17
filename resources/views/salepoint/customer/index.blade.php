<x-salepoint>
    @section('title', 'Customer List')

    <div class="container-fluid">
        <form action="{{ route('salepoint_customer_index') }}" method="GET">
            @csrf
            <div class="row my-3">
                <div class="col-md-3">
                    <label for="area" class="form-label">Area</label>
                    <select id="area" name="area">
                        @foreach ($areas as $area)
                            <option value="{{ $area->id }}">{{ $area->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="product" class="form-label">Search</label>
                    <input type="text" class="form-control" name="query" placeholder="Search Query..">
                </div>
                <div class="col-md-2">
                    <label for="action" class="form-label">Action</label>
                    <div class="d-flex">
                        <button type="submit" id="addButton" class="btn btn-primary">Filter</button>
                        <a href="{{ route('salepoint_customer_index') }}" class="btn btn-danger ms-3">Reset</a>
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
                            <th>Name</th>
                            <th>Area</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Image</th>
                            <th>SalePoint</th>
                            <th>Balance</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customers as $customer)
                            <tr>
                                <td>{{ $customer->id }}</td>
                                <td>{{ $customer->name }}</td>
                                <td>{{ optional($customer->area)->name }}</td>
                                <td>{{ $customer->address }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>
                                    @if ($customer->image)
                                        <img src="{{ asset('storage/img/' . $customer->image) }}" alt="{{ $customer->name }}" width="50" class="rounded-circle">
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td>{{ optional($customer->creator)->name }}</td>
                                <td style="background-color: {{ $customer->balance < 0 ? 'red' : 'green' }}; color: white;">
                                    {{$settings->currency}}{{ $customer->balance }}
                                </td>                                
                                <td>
                                    <a href="#" class="btn btn-primary balance-add" 
                                       data-id="{{ $customer->id }}" 
                                       data-name="{{ $customer->name }}" 
                                       data-balance="{{ $customer->balance }}">
                                        <i class="fas fa-hand-holding-usd"></i>
                                    </a>
                                    <a href="{{ route('salepoint_customers.edit', $customer->id) }}" class="btn btn-secondary edit-btn"><i class="fas fa-edit"></i></a>
                                   
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Balance Add Modal -->
    <div class="modal fade" id="balanceAddModal" tabindex="-1" role="dialog" aria-labelledby="balanceAddModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('customer_deposit') }}" method="POST" id="depositForm">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="balanceAddModalLabel">Add Deposit for <span id="customerName"></span></h5>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="customer_id" id="customerId">
                        <div class="form-group">
                            <label for="currentBalance">Current Balance</label>
                            <input type="text" id="currentBalance" class="form-control" readonly>
                        </div>
                        <div class="form-group my-2">
                            <label for="depositAmount">Deposit Amount</label>
                            <input type="number" name="depositAmount" id="depositAmount" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="newBalance">New Balance</label>
                            <input type="text" id="newBalance" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Deposit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Tom Select for the dropdown elements
            new TomSelect('#area');

            // Open the modal on click of balance-add button
            $('.balance-add').on('click', function() {
                var customerId = $(this).data('id');
                var customerName = $(this).data('name');
                var currentBalance = $(this).data('balance');

                $('#customerId').val(customerId);
                $('#customerName').text(customerName);
                $('#currentBalance').val(currentBalance);
                $('#newBalance').val(currentBalance);

                $('#balanceAddModal').modal('show');
            });

            // Calculate new balance on input change
            $('#depositAmount').on('input', function() {
                var currentBalance = parseFloat($('#currentBalance').val());
                var depositAmount = parseFloat($(this).val());

                var newBalance = currentBalance + depositAmount;
                $('#newBalance').val(newBalance);
            });

            // Confirm delete action
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
        });

        function closeAlert(button) {
            button.parentElement.parentElement.remove();
        }
    </script>
</x-layouts>
