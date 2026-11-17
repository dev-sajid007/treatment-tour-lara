<x-salepoint>
    @section('title', 'Supplier/Brand List')
    
    <div class="container-fluid">
        <!-- start page title -->
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
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>All Supplier/Brand</h5>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBrandModal">Add Supplier</button>
                    </div>
                    <div class="card-body">
                        <table id="example" class="table table-striped table-bordered dt-responsive nowrap"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Supplier Name</th>
                                    <th>Balance</th>
                                    <th>Details</th>
                                    <th>Creator</th>
                                    <th>Create Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($brands as $brand)
                                <tr>
                                    <td>{{$brand->id}}</td>
                                    <td>{{$brand->name}}</td>
                                    <td style="background-color: {{ $brand->balance > 0 ? 'red' : 'green' }}; color: white;">
                                        {{$settings->currency}}{{ $brand->balance }}
                                    </td>
                                    <td>{{$brand->details}}</td>
                                    <td>{{ optional($brand->creator)->name }}</td>
                                    <td>{{$brand->created_at->format("d-M-Y")}}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('salepoint_brand_edit', $brand->id) }}" class="btn btn-info"><i class="fas fa-edit"></i></a>
                                            <button class="btn btn-success ms-2" data-bs-toggle="modal" data-bs-target="#depositModal-{{ $brand->id }}"><i class="fas fa-hand-holding-usd"></i></button>
                                                                                     
                                        </div>
                                    </td>
                                </tr>

                                <!-- Deposit Modal -->
                                <div class="modal fade" id="depositModal-{{ $brand->id }}" tabindex="-1" aria-labelledby="depositModalLabel-{{ $brand->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="depositModalLabel-{{ $brand->id }}">Deposit to {{ $brand->name }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('salepoint_brand.deposit', $brand->id) }}" method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="current_balance">Current Balance</label>
                                                        <input type="text" class="form-control" id="current_balance-{{ $brand->id }}" value="{{ $brand->balance }}" readonly>
                                                    </div>
                                                    <div class="form-group mt-3">
                                                        <label for="deposit_amount">Deposit Amount</label>
                                                        <input type="number" class="form-control" name="deposit_amount" id="deposit_amount-{{ $brand->id }}" required>
                                                    </div>
                                                    <div class="form-group mt-3">
                                                        <label for="new_balance">New Balance</label>
                                                        <input type="text" class="form-control" id="new_balance-{{ $brand->id }}" readonly>
                                                    </div>
                                                    <div class="form-group mt-3">
                                                            <label for="bank">Payment Method</label>
                                                            <select name="bank" id="bank" class="form-control">
                                                                @foreach ($banks as $bank)
                                                                    <option value="{{$bank->id}}">{{$bank->name}}</option>
                                                                @endforeach
                                                            </select>
                                                    </div>
                                                    <div class="form-group mt-4">
                                                        <input type="submit" value="Deposit" class="btn btn-outline-success">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Add Supplier Modal -->
    <div class="modal fade" id="addBrandModal" tabindex="-1" aria-labelledby="addBrandModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addBrandModalLabel">Add Supplier</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="add-brand-form" method="POST" action="{{ route('salepoint_brand_store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Supplier Name</label>
                            <input type="text" placeholder="Supplier Name" id="name" name="name" class="form-control"> 
                            <br>
                            <label for="details">Supplier Details</label>
                            <textarea name="details" id="details" class="form-control"></textarea>
                            <br>
                            <input type="submit" value="Add Supplier" class="btn btn-outline-success">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function closeAlert(button) {
            button.parentElement.parentElement.remove();
        }
    
        document.getElementById('add-brand-form').addEventListener('submit', function(event) {
            let nameInput = document.getElementById('name');
            if (!nameInput.value.trim()) {
                event.preventDefault();
                nameInput.classList.add('border', 'border-danger');
            }
        });
    
        document.getElementById('name').addEventListener('input', function() {
            if (this.value.trim()) {
                this.classList.remove('border', 'border-danger');
            }
        });

        function updateNewBalance(brandId) {
            const depositAmount = parseFloat(document.getElementById('deposit_amount-' + brandId).value) || 0;
            const currentBalance = parseFloat(document.getElementById('current_balance-' + brandId).value) || 0;
            const newBalance = currentBalance - depositAmount;
            document.getElementById('new_balance-' + brandId).value = newBalance.toFixed(2);
        }

        document.querySelectorAll('[id^="deposit_amount-"]').forEach(input => {
            input.addEventListener('input', function() {
                const brandId = this.id.split('-')[1];
                updateNewBalance(brandId);
            });
        });

        function confirmDelete(brandId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + brandId).submit();
                }
            });
        }
    </script>
    
</x-salepoint>
