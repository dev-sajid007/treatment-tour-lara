<x-salepoint>

    @section('title', 'Update Godown')
    
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
                        <h5>Update Godown</h5>
                   </div>
                     <div class="card-body">
                        <form method="POST" action="{{ route('salepoint_godown_update',$godown->id) }}">
                            @csrf
                            <div class="form-group">
                                 <label for="name">Godown Name</label>
                                 <input type="text" placeholder="Godown Name" id="name" value="{{$godown->name}}" name="name" class="form-control"> 
                                 <br>
                                 <textarea name="details" id="details" class="form-control">{{$godown->details}}</textarea>
                                 <br>
                                  <input type="submit" value="Update Brand" class="btn btn-outline-success">
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

 </x-salepoint>
 