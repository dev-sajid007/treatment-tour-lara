@extends('layouts.admin')

@section('content')
<style type="text/css">
    .btn-custom {
    background-color: #b00b47;
    color: white;
    border: none;
}

</style>



<script src="https://cdn.ckeditor.com/ckeditor5/36.0.0/classic/ckeditor.js"></script>

@php
    use App\Models\Meeting;
    $meeting = Meeting::where('patient_id', $patient)
                      ->where('doctor_id', auth()->user()->id)
                      ->where('appointment_id', $appointment)
                      ->latest()
                      ->first();
@endphp

<div class="card shadow">
    <div class="card-body text-center">
        @if ($meeting && $meeting->start_url)
            <p><strong>Meeting Link:</strong></p>
            <div class="input-group">
                <input type="text" class="form-control" id="zoomLink" value="{{ $meeting->start_url }}" readonly>
                <button class="btn btn-primary" onclick="copyToClipboard()">
                    <i class="fas fa-copy"></i> Copy
                </button>
            </div>
        @else
            <p class="text-muted">No scheduled Zoom meeting found.</p>
        @endif

         <div class="text-left mt-4">
            <h5 id="email">Patient Email: <span id="patientEmail">{{ $patientUser->email }}</span></h5>
            <button class="btn btn-sm btn-primary" onclick="copyToClipboard()">
                <i class="fas fa-copy"></i> Copy
            </button>
            <span id="copyMessage" class="text-success ml-2" style="display: none;">Copied!</span>
        </div>
    </div>
</div>

<div class="container-fluid mt-4">
    <div class="card shadow">
        <div class="card-header text-white" style="background-color: #b00b47;">
            <h4 class="text-white">Create Prescription</h4>   <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#patientHistoryModal">
                View Patient History
            </button> 

             <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#patientReportModal">
                View Patient Reports
            </button>

            <button type="button" class="btn btn-success " data-bs-toggle="modal" data-bs-target="#addZoomModal">
    Add Zoom Meeting
</button>

        </div>
        <div class="card-body">
            <form action="{{route('prescriptions.store')}}" method="POST">
                @csrf

                <!-- Date and Appointment -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="date" name="date" value="{{$appointment_info->appointment_date}}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="appointment_id" class="form-label">Appointment For</label>
                        <input type="text" class="form-control"   value="{{$appointment_info->reason}}">
                        <input type="hidden" class="form-control"  name="appointment_id" value="{{$appointment_info->id}}">
                        <input type="hidden" class="form-control"  name="patient_id" value="{{$patientUser->id}}">
                    </div>
                </div>

                <!-- Symptoms, Diagnosis, Notes -->
                <div class="mb-3">
                    <label for="symptoms" class="form-label">Symptoms</label>
                    <textarea class="form-control" id="symptoms" name="symptoms" rows="3" placeholder="Enter symptoms"></textarea>
                </div>
                <div class="mb-3">
                    <label for="symptoms" class="form-label">Tests</label>
                    <textarea class="form-control" id="tests" name="tests" rows="3" placeholder="Enter tests"></textarea>
                </div>
                <div class="mb-3">
                    <label for="diagnosis" class="form-label">Diagnosis</label>
                    <textarea class="form-control" id="diagnosis" name="diagnosis" rows="3" placeholder="Enter diagnosis"></textarea>
                </div>
                <div class="mb-3">
                    <label for="notes" class="form-label">Notes</label>
                    <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Enter additional notes"></textarea>
                </div>

                <!-- Medications -->
                <div class="mb-3">
                    <label class="form-label">Medications</label>
                    <div id="medication-list">
                        <div class="row mb-2 medication-row">
                            <div class="col-md-5 position-relative">
                                <input type="text" class="form-control medication-name" name="medications[0][name]" placeholder="Search medication..." autocomplete="off">
                                <div class="dropdown-menu medication-suggestions"></div>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control" name="medications[0][dosage]" placeholder="Dosage" required>
                            </div>
                            <div class="col-md-2">
                                <input type="text" class="form-control" name="medications[0][frequency]" placeholder="Frequency" required>
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-danger btn-sm remove-medication">Remove</button>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary btn-sm" id="add-medication">Add Medication</button>
                </div>


                <!-- Submit Button -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-custom">Save Prescription</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Patient History Modal -->
<div class="modal fade" id="patientHistoryModal" tabindex="-1" aria-labelledby="patientHistoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="patientHistoryModalLabel">Patient History</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Patient Details -->
                <h5 class="mb-3">Patient Details</h5> 
                <p><strong>Patient Name:</strong> {{ $patientHistory->patient->name ?? 'N/A' }}</p>
                <p><strong>Guardian Name:</strong> {{ $patientHistory->guardian_name ?? 'N/A' }}</p>
                <p><strong>Guardian Relationship:</strong> {{ $patientHistory->guardian_relationship ?? 'N/A' }}</p>
                <p><strong>Guardian Contact:</strong> {{ $patientHistory->guardian_contact_number ?? 'N/A' }}</p>
                <p><strong>Guardian Email:</strong> {{ $patientHistory->guardian_email ?? 'N/A' }}</p>

                <!-- Medical Information -->
                <h5 class="mt-4 mb-3">Medical Information</h5>
                <p><strong>Medical Conditions:</strong> {!! $patientHistory->medical_conditions ?? 'N/A' !!}</p>
                <p><strong>Medications:</strong> {!! $patientHistory->medications ?? 'N/A' !!}</p>
                <p><strong>Allergies:</strong> {!! $patientHistory->allergies ?? 'N/A' !!}</p>
                <p><strong>Surgical History:</strong> {!! $patientHistory->surgical_history ?? 'N/A' !!}</p>
                <p><strong>Family History:</strong> {!! $patientHistory->family_history ?? 'N/A' !!}</p>

                <!-- Social and Mental Health -->
                <h5 class="mt-4 mb-3">Social and Mental Health</h5>
                <p><strong>Social History:</strong> {!! $patientHistory->social_history ?? 'N/A' !!}</p>
                <p><strong>Vaccination History:</strong> {!! $patientHistory->vaccination_history ?? 'N/A' !!}</p>
                <p><strong>Disease History:</strong> {!! $patientHistory->disease_history ?? 'N/A' !!}</p>
                <p><strong>Past Treatments:</strong> {!! $patientHistory->past_treatments ?? 'N/A' !!}</p>
                <p><strong>Mental Health History:</strong> {!! $patientHistory->mental_health_history ?? 'N/A' !!}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>




<!-- Patient Reports Modal -->
<div class="modal fade" id="patientReportModal" tabindex="-1" aria-labelledby="patientReportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="patientReportModalLabel">Patient Reports</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              @foreach($reports as $report)
              <div class="mt-4 mb-4">
                <h4 class="mt-2 mb-2">{{$report->title}} </h4>
                <img src="{{ asset($report->report_image) }}"  class="img-fluid max-width: 100%" alt="Report Image">
              </div>
              @endforeach
              
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="addZoomModal" tabindex="-1" aria-labelledby="addZoomModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addZoomModalLabel">Add Zoom Meeting</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('zoom.create') }}" method="POST" class="mb-4">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Meeting Topic:</label>
                        <input type="text" name="topic" class="form-control" required>

                        <input type="hidden" name="patient_id" class="form-control" value="{{$patient}}">
                        <input type="hidden" name="appointment_id" class="form-control" value="{{$appointment}}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Start Time:</label>
                        <input type="datetime-local" name="start_time" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Duration (minutes):</label>
                        <input type="number" name="duration" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password (Optional):</label>
                        <input type="text" name="password" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Create Meeting</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="zoomForm">Save Meeting</button>
            </div>
        </div>
    </div>
</div>


<script>
   document.addEventListener('DOMContentLoaded', function () {
    let medicationIndex = 1;

    // Add Medication Row
    document.getElementById('add-medication').addEventListener('click', function () {
        const medicationList = document.getElementById('medication-list');
        const newRow = document.createElement('div');
        newRow.classList.add('row', 'mb-2', 'medication-row');
        newRow.innerHTML = `
            <div class="col-md-5 position-relative">
                <input type="text" class="form-control medication-name" name="medications[${medicationIndex}][name]" placeholder="Search medication..." autocomplete="off">
                <div class="dropdown-menu medication-suggestions"></div>
            </div>
            <div class="col-md-2">
                <input type="text" class="form-control" name="medications[${medicationIndex}][dosage]" placeholder="Dosage" required>
            </div>
            <div class="col-md-2">
                <input type="text" class="form-control" name="medications[${medicationIndex}][frequency]" placeholder="Frequency" required>
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger btn-sm remove-medication">Remove</button>
            </div>
        `;
        medicationList.appendChild(newRow);
        medicationIndex++;
    });

    // Remove Medication Row
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-medication')) {
            const row = e.target.closest('.medication-row');
            if (row) row.remove();
        }
    });

    // Medication Search Logic remains the same
    document.addEventListener('input', function (e) {
        if (e.target.classList.contains('medication-name')) {
            const query = e.target.value.trim();
            const suggestionsBox = e.target.nextElementSibling;

            if (query.length > 2) {
                fetch(`/medications/search?query=${query}`)
                    .then(response => response.json())
                    .then(data => {
                        suggestionsBox.innerHTML = '';
                        suggestionsBox.classList.add('show');

                        if (data.length) {
                            data.forEach(medication => {
                                const suggestionItem = document.createElement('button');
                                suggestionItem.classList.add('dropdown-item');
                                suggestionItem.textContent = medication.name;
                                suggestionItem.type = 'button';
                                suggestionItem.addEventListener('click', () => {
                                    e.target.value = medication.name;
                                    suggestionsBox.classList.remove('show');
                                });
                                suggestionsBox.appendChild(suggestionItem);
                            });
                        } else {
                            const fallbackItem = document.createElement('button');
                            fallbackItem.classList.add('dropdown-item', 'text-muted');
                            fallbackItem.type = 'button';
                            fallbackItem.textContent = 'No results found. Press Enter to add manually.';
                            suggestionsBox.appendChild(fallbackItem);
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching medications:', error);
                        suggestionsBox.classList.remove('show');
                    });
            } else {
                suggestionsBox.innerHTML = '';
                suggestionsBox.classList.remove('show');
            }
        }
    });

    // Hide suggestions on outside click
    document.addEventListener('click', function (e) {
        if (!e.target.classList.contains('medication-name')) {
            document.querySelectorAll('.medication-suggestions').forEach(suggestionsBox => {
                suggestionsBox.classList.remove('show');
            });
        }
    });
});

</script>


<script>
    ClassicEditor
        .create(document.querySelector('#diagnosis'))
        .catch(error => {
            console.error('CKEditor error:', error);
        });

    ClassicEditor
        .create(document.querySelector('#tests'))
        .catch(error => {
            console.error('CKEditor error:', error);
        });
    ClassicEditor
        .create(document.querySelector('#symptoms'))
        .catch(error => {
            console.error('CKEditor error:', error);
        });

    ClassicEditor
        .create(document.querySelector('#notes'))
        .catch(error => {
            console.error('CKEditor error:', error);
        });
</script>

<script>
    function copyToClipboard() {
        var copyText = document.getElementById("zoomLink");
        copyText.select();
        copyText.setSelectionRange(0, 99999); // For mobile devices
        document.execCommand("copy");

        // Alert or tooltip feedback
        alert("Meeting link copied!");
    }
</script>

<script>
    function copyToClipboard() {
        // Get the email text
        const emailText = document.getElementById("patientEmail").innerText;

        // Copy to clipboard using navigator API
        navigator.clipboard.writeText(emailText).then(function() {
            // Show success message
            const message = document.getElementById("copyMessage");
            message.style.display = "inline";
            setTimeout(() => {
                message.style.display = "none";
            }, 2000); // Hide after 2 seconds
        }).catch(function(err) {
            console.error("Failed to copy: ", err);
        });
    }
</script>
@endsection

