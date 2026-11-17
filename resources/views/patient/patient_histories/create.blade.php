@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-4">
    <div class="card border-0 shadow p-4">
        <h2 class="mb-4">{{ isset($patientHistory) ? 'Edit My Medical History' : 'My Medical History' }}</h2>

        <!-- Display Success/Error Messages -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ isset($patientHistory) ? route('patient.infos.update', $patientHistory->id) : route('patient.infos.store') }}" method="POST">
            @csrf
            @if (isset($patientHistory))
                @method('PUT')
            @endif


            <div class="form-group mb-3">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name ?? '') }}">
            </div>



            <div class="form-group mb-3">
                <label for="Email">Email:</label>
                <input type="text" class="form-control" id="email" name="email" value="{{ old('email', $user->email ?? '') }}">
            </div>

            <div class="form-group mb-3">
                <label for="DOB">DOB:</label>
                <input type="date" class="form-control" id="email" name="date_of_birth" value="{{ old('date_of_birth', $user->date_of_birth ?? '') }}">
            </div>

            <div class="form-group mb-3">
                <label for="guardian_name">Guardian Name:</label>
                <input type="text" class="form-control" id="guardian_name" name="guardian_name" value="{{ old('guardian_name', $patientHistory->guardian_name ?? '') }}">
            </div>

            <div class="form-group mb-3">
                <label for="guardian_relationship">Guardian Relationship:</label>
                <input type="text" class="form-control" id="guardian_relationship" name="guardian_relationship" value="{{ old('guardian_relationship', $patientHistory->guardian_relationship ?? '') }}">
            </div>

            <div class="form-group mb-3">
                <label for="guardian_contact_number">Guardian Contact Number:</label>
                <input type="text" class="form-control" id="guardian_contact_number" name="guardian_contact_number" value="{{ old('guardian_contact_number', $patientHistory->guardian_contact_number ?? '') }}">
            </div>

            <div class="form-group mb-3">
                <label for="guardian_email">Guardian Email:</label>
                <input type="email" class="form-control" id="guardian_email" name="guardian_email" value="{{ old('guardian_email', $patientHistory->guardian_email ?? '') }}">
            </div>

            <!-- CKEditor-enabled Textareas -->
            @foreach ([
                'medical_conditions' => 'Medical Conditions',
                'medications' => 'Medications',
                'allergies' => 'Allergies',
                'surgical_history' => 'Surgical History',
                'family_history' => 'Family History',
                'social_history' => 'Social History',
                'vaccination_history' => 'Vaccination History',
                'disease_history' => 'Disease History',
                'past_treatments' => 'Past Treatments',
                'mental_health_history' => 'Mental Health History',
            ] as $field => $label)
                <div class="form-group mb-3">
                    <label for="{{ $field }}">{{ $label }}:</label>
                    <textarea class="form-control ckeditor" id="{{ $field }}" name="{{ $field }}">{{ old($field, $patientHistory->$field ?? '') }}</textarea>
                </div>
            @endforeach

            <button type="submit" class="btn btn-primary">{{ isset($patientHistory) ? 'Update' : 'Submit' }}</button>
        </form>
    </div>
</div>

<!-- CKEditor 5 Script -->
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.0/classic/ckeditor.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll('.ckeditor').forEach(function (textarea) {
            ClassicEditor
                .create(textarea)
                .catch(error => console.error(error));
        });
    });
</script>
@endsection












