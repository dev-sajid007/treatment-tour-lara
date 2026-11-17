@extends('layouts.admin')

@section('content')
<style type="text/css">
    .btn-custom {
        background-color: #b00b47;
        color: white;
        border: none;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.0/classic/ckeditor.js"></script>

@php
    use App\Models\Meeting;
    $meeting = Meeting::where('patient_id', $patientUser->id)
                      ->where('doctor_id', auth()->user()->id)
                      ->where('appointment_id', $appointmentId)
                      ->latest()
                      ->first();
    //$medications = $prescription->medications ? $prescription->medications : [];

$medications = \App\Models\Doctor\Medication::where('prescription_id', $prescription->id )->get();
@endphp



<div class="card shadow">
    <div class="card-body text-left">
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
            <h4 class="text-white">Edit Prescription</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('prescriptions.update', $prescription->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Date and Appointment -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="date" name="date" value="{{ $prescription->date }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="appointment_id" class="form-label">Appointment</label>
                        <input type="text" class="form-control" value="{{ $appointment_info->reason ?? ''}}">
                        <input type="hidden" class="form-control" name="appointment_id" value="{{ $prescription->appointment_id }}">
                        <input type="hidden" class="form-control" name="patient_id" value="{{ $prescription->patient_id }}">
                    </div>
                </div>

                <!-- Symptoms, Diagnosis, Notes -->
                <div class="mb-3">
                    <label for="symptoms" class="form-label">Symptoms</label>
                    <textarea class="form-control" id="symptoms" name="symptoms" rows="3">{!! $prescription->symptoms !!}</textarea>
                </div>
                <div class="mb-3">
                    <label for="tests" class="form-label">Tests</label>
                    <textarea class="form-control" id="tests" name="tests" rows="3">{!! $prescription->tests !!}</textarea>
                </div>
                <div class="mb-3">
                    <label for="diagnosis" class="form-label">Diagnosis</label>
                    <textarea class="form-control" id="diagnosis" name="diagnosis" rows="3">{!! $prescription->diagnosis !!}</textarea>
                </div>
                <div class="mb-3">
                    <label for="notes" class="form-label">Advice</label>
                    <textarea class="form-control" id="notes" name="notes" rows="3">{!! $prescription->notes !!}</textarea>
                </div>

                <!-- Medications -->
                <div class="form-group">
                    <label>Medications</label>
                    <div id="medications-list">
                        @if($medications)
                        @forelse($medications as $index => $medication)
                            <div class="row mb-2 medication-row">
                                <div class="col-md-5 position-relative">
                                    <input type="text" class="form-control medication-name" name="medications[{{ $index }}][name]" value="{{ $medication['name'] ?? '' }}" placeholder="Search medication..." autocomplete="off">
                                    <div class="dropdown-menu medication-suggestions"></div>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control" name="medications[{{ $index }}][dosage]" value="{{ $medication['dosage'] ?? '' }}" placeholder="Dosage" required>
                                </div>
                                <div class="col-md-2">
                                    <input type="text" class="form-control" name="medications[{{ $index }}][frequency]" value="{{ $medication['frequency'] ?? '' }}" placeholder="Frequency" required>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-danger btn-sm remove-medication">Remove</button>
                                </div>
                            </div>
                        @empty
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
                        @endforelse
                    @endif
                    </div>
                    <button type="button" id="add-medication" class="btn btn-primary btn-sm mt-2">Add Medication</button>
                </div>



                <!-- Submit Button -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-custom">Save Prescription</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
          let medicationIndex = {{ count($medications) > 0 ? count($medications) : 1 }};

        // Add Medication Row
        document.getElementById('add-medication').addEventListener('click', function () {
            const medicationsList = document.getElementById('medications-list');

            const newRow = document.createElement('div');
            newRow.className = 'row mb-2 medication-row';
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
            medicationsList.appendChild(newRow);
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
                            }
                        });
                } else {
                    suggestionsBox.classList.remove('show');
                }
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
