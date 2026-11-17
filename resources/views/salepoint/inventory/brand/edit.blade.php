<x-salepoint>

    @section('title', 'Update Supplier/Brand')
    
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
            <div class="col-md-4 mx-auto">
                  <div class="card">
                    <div class="card-header">
                        <h5>Update Supplier/Brand</h5>
                   </div>
                     <div class="card-body">
                        <form method="POST" action="{{ route('salepoint_brand_update',$brands->id) }}">
                            @csrf
                            <div class="form-group">
                                 <label for="name">Supplier Name</label>
                                 <input type="text" placeholder="Supplier Name" id="name" value="{{$brands->name}}" name="name" class="form-control"> 
                                 <br>
                                 <textarea name="details" id="details" class="form-control">{{$brands->details}}</textarea>
                                 <br>
                                  <input type="submit" value="Update Supplier" class="btn btn-outline-success">
                            </div>
                        </form>
                     </div>
                  </div>
            </div>
        </div>
    </div>


<script>
    function closeAlert(button) {
        button.parentElement.parentElement.remove();
    }
</script>

 </x-layouts>
 