 @extends('layouts.admin')

@section('content')
<div class="container-fluid mt-2">
   <div class="card border-0 p-3">
 <h1>Edit Patient History</h1>

    <!-- Display Success/Error Messages -->
    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @elseif(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <form action="{{ route('patient_histories.update', $patientHistory->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Guardian Name -->
        <label for="guardian_name">Guardian Name:</label>
        <input type="text" id="guardian_name" name="guardian_name" value="{{ old('guardian_name', $patientHistory->guardian_name) }}"><br>

        <!-- Guardian Relationship -->
        <label for="guardian_relationship">Guardian Relationship:</label>
        <input type="text" id="guardian_relationship" name="guardian_relationship" value="{{ old('guardian_relationship', $patientHistory->guardian_relationship) }}"><br>

        <!-- Guardian Contact Number -->
        <label for="guardian_contact_number">Guardian Contact Number:</label>
        <input type="text" id="guardian_contact_number" name="guardian_contact_number" value="{{ old('guardian_contact_number', $patientHistory->guardian_contact_number) }}"><br>

        <!-- Guardian Email -->
        <label for="guardian_email">Guardian Email:</label>
        <input type="email" id="guardian_email" name="guardian_email" value="{{ old('guardian_email', $patientHistory->guardian_email) }}"><br>

        <!-- Medical Conditions -->
        <label for="medical_conditions">Medical Conditions:</label>
        <textarea id="medical_conditions" name="medical_conditions">{{ old('medical_conditions', $patientHistory->medical_conditions) }}</textarea><br>

        <!-- Medications -->
        <label for="medications">Medications:</label>
        <textarea id="medications" name="medications">{{ old('medications', $patientHistory->medications) }}</textarea><br>

        <!-- Allergies -->
        <label for="allergies">Allergies:</label>
        <textarea id="allergies" name="allergies">{{ old('allergies', $patientHistory->allergies) }}</textarea><br>

        <!-- Surgical History -->
        <label for="surgical_history">Surgical History:</label>
        <textarea id="surgical_history" name="surgical_history">{{ old('surgical_history', $patientHistory->surgical_history) }}</textarea><br>

        <!-- Family History -->
        <label for="family_history">Family History:</label>
        <textarea id="family_history" name="family_history">{{ old('family_history', $patientHistory->family_history) }}</textarea><br>

        <!-- Social History -->
        <label for="social_history">Social History:</label>
        <textarea id="social_history" name="social_history">{{ old('social_history', $patientHistory->social_history) }}</textarea><br>

        <!-- Vaccination History -->
        <label for="vaccination_history">Vaccination History:</label>
        <textarea id="vaccination_history" name="vaccination_history">{{ old('vaccination_history', $patientHistory->vaccination_history) }}</textarea><br>

        <!-- Disease History -->
        <label for="disease_history">Disease History:</label>
        <textarea id="disease_history" name="disease_history">{{ old('disease_history', $patientHistory->disease_history) }}</textarea><br>

        <!-- Past Treatments -->
        <label for="past_treatments">Past Treatments:</label>
        <textarea id="past_treatments" name="past_treatments">{{ old('past_treatments', $patientHistory->past_treatments) }}</textarea><br>

        <!-- Mental Health History -->
        <label for="mental_health_history">Mental Health History:</label>
        <textarea id="mental_health_history" name="mental_health_history">{{ old('mental_health_history', $patientHistory->mental_health_history) }}</textarea><br>

        <button type="submit">Update</button>
    </form>


    @endsection
