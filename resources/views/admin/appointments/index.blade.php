@extends('layouts.admin')
@section('title', 'Appointments List')
@section('content')
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10 mx-auto">
                <div class="card">
                    <div class="card-header">
                         All Appointments
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
                                    <th>Client Name</th>
                                    <th>Doctor Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Address</th>
                                    <th>Message</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($appointments as $appointment)
                                    <tr>
                                        <td>{{ $appointment->id }}</td>
                                        <td>{{ $appointment->clinic->name }}</td>
                                        <td>{{ $appointment->doctor->name }}</td>
                                        <td>{{ $appointment->email }}</td>
                                        <td>{{ $appointment->phone }}</td>
                                        <td>{{ $appointment->address }}</td>
                                        <td>{{ $appointment->message }}</td>
                                        <td>
                                            
                                           <button class="btn btn-info btn-sm" onclick="sendEmail('{{ $appointment->doctor->email }}', '{{ $appointment->clinic->email }}', {
        client_name: '{{ $appointment->clinic->name }}', // Example client name
        client_email: '{{ $appointment->email }}', // Client email
        client_phone: '{{ $appointment->phone }}', // Client phone
        client_address: '{{ $appointment->address }}', // Client address
        message: '{{ $appointment->message }}' // Additional message
    })">Send Email</button>
    
                                            
                                            
                                            <form action="{{ route('admin.appointments.destroy', $appointment->id) }}" method="POST" style="display:inline;">
                                                
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this appointment?');">Delete</button>
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
    
    
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        function closeAlert(button) {
            button.parentElement.parentElement.remove();
        }
        
    function sendEmail(doctorEmail, clinicEmail, appointment) {
        console.log('Sending Email:', appointment); // Debugging log
    
        $.ajax({
            url: '{{ route('admin.appointments.sendEmail') }}',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                doctor_email: doctorEmail,
                clinic_email: clinicEmail,
                client_name: appointment.client_name, // Add client name
                client_email: appointment.client_email, // Add client email
                client_phone: appointment.client_phone, // Add client phone
                client_address: appointment.client_address, // Add client address
                message: appointment.message // Add appointment message
            }),
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            success: function(data) {
                if (data.success) {
                    alert('Email sent successfully!');
                } else {
                    alert('Error sending email.');
                }
            },
            error: function(xhr) {
                // Handle validation error
                if (xhr.status === 422) {
                    const errorMessage = xhr.responseJSON.errors 
                        ? Object.values(xhr.responseJSON.errors).flat().join('\n') 
                        : 'Invalid input data';
                    alert('Error: ' + errorMessage);
                } else {
                    alert('Error: ' + xhr.statusText);
                }
                console.error('Error:', xhr);
            }
        });
    }
    
    </script>
    
    
@endsection
    