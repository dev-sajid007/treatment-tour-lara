@extends('layouts.admin')
    @section('title', 'Contacts List')
    @section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10 mx-auto">
                <div class="card">
                    <div class="card-header">
                         All Contact
                    </div>

                    <div class="card-body">
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
                   
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Contact Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Present Address</th>
                                    <th>Message</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($contacts as $contact)
                                    <tr>
                                        <td>{{ $contact->id }}</td>
                                        <td>{{ $contact->first_name }} {{ $contact->last_name }}</td>
                                        <td>{{ $contact->email }}</td>
                                        <td>{{ $contact->phone_number }}</td>
                                        <td>{{ $contact->present_address }}</td>
                                        <td>{{ $contact->message }}</td>
                                        <td>
                                            <!-- Add actions such as delete or edit here -->
                                            <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this contact?');">Delete</button>
                                            </form>
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
@endsection
