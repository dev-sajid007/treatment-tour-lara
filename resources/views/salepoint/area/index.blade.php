<x-salepoint>

    @section('title', 'Customer Group List')
    
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
                        <h5>Add Customer Group/Area</h5>
                   </div>
                     <div class="card-body">
                        <form method="POST" action="{{ route('salepoint_add_area_store') }}">
                            @csrf
                            <div class="form-group">
                                 <label for="name">Group Name</label>
                                 <input type="text" placeholder="Group Name" id="name" name="name" class="form-control"> 
                                 <br>
                                 <label for="details">Group Details</label>
                                 <textarea name="details" id="details" class="form-control"></textarea>
                                 <br>
                                  <input type="submit" value="Add Group" class="btn btn-outline-success">
                            </div>
                        </form>
                     </div>
                  </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>All Group/Area</h5>
                   </div>
                     <div class="card-body">
                        <table id="example" class="table table-striped table-bordered dt-responsive nowrap"
                            style="width:100%">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Group name</th>
                                    <th>Details</th>
                                    <th>Create date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($areas as $area)
                                <tr>
                                    <td>{{$area->id}}</td>
                                    <td>{{$area->name}}</td>
                                    <td>{{$area->details}}</td>
                                    <td>{{$area->created_at->format("d-M-Y")}}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('salepoint_area_edit', $area->id) }}" class="btn btn-info"><i class="fas fa-edit"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                              
                            </tbody>
                        </table>
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
 