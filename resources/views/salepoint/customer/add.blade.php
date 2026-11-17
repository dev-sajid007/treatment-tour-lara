<x-salepoint>
    @section('title', 'Add Customer')

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
                        <h5>Add Customer</h5>
                   </div>
                     <div class="card-body">
                        <form method="POST" action="{{ route('salepoint_add_customer_store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                 <div class="col-md-6">
                                    <label for="name">Customer Name</label>
                                    <input type="text" placeholder="Customer Name" id="name" name="name" value="{{ old('name') }}" class="form-control">
                                 </div>
                                 <div class="col-md-6">
                                      <label for="area">Area</label>
                                      <select name="area" id="area" >
                                           @foreach ($areas as $area)
                                            <option value="{{ $area->id }}">{{ $area->name }}</option>
                                           @endforeach
                                      </select>
                                 </div>
                            </div>
                            <div class="row my-4">
                                <div class="col-md-6">
                                    <label for="address">Address</label>
                                    <input type="text" placeholder="Address" id="address" name="address" value="{{ old('address') }}" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label for="phone">Phone</label>
                                    <input type="text" placeholder="Phone" id="phone" name="phone" value="{{ old('phone') }}" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="email">Email</label>
                                    <input type="email" placeholder="Email" id="email" name="email" value="{{ old('email') }}" class="form-control">
                                </div>
                                <div class="col-md-6 ">
                                    <label for="image">Image (Optional)</label>
                                    <input type="file" id="image" name="image" class="form-control">
                                </div>
                            </div>
                            <div class="form-group mt-4">
                                  <input type="submit" value="Add Customer" class="btn btn-outline-success">
                            </div>
                        </form>
                     </div>
                  </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize Tom Select for the area dropdown
            new TomSelect('#area');
        });

        function closeAlert(button) {
            button.parentElement.parentElement.remove();
        }
    </script>
</x-salepoint>
