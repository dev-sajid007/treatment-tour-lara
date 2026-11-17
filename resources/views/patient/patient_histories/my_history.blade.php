@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>Patient History Details</h3>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>Patient ID</th>
                        <td>{{ $user->serial ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Patient Name</th>
                        <td>{{ $user->name ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Patient Email</th>
                        <td>{{ $user->email ?? '' }}</td>
                    </tr>
                    <tr>
                        <th>Guardian Name</th>
                        <td>{{ $patient->guardian_name ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Guardian Relationship</th>
                        <td>{{ $patient->guardian_relationship ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Guardian Contact Number</th>
                        <td>{{ $patient->guardian_contact_number ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Guardian Email</th>
                        <td>{{ $patient->guardian_email ?? 'N/A' }}</td>
                    </tr>
                    <tr>
                        <th>Medical Conditions</th>
                        <td>{!! $patient->medical_conditions ?? 'N/A' !!}</td>
                    </tr>
                    <tr>
                        <th>Medications</th>
                        <td>{!!  $patient->medications ?? 'N/A' !!}</td>
                    </tr>
                    <tr>
                        <th>Allergies</th>
                        <td>{!!  $patient->allergies ?? 'N/A' !!}</td>
                    </tr>
                    <tr>
                        <th>Surgical History</th>
                        <td>{!!  $patient->surgical_history ?? 'N/A' !!}</td>
                    </tr>
                    <tr>
                        <th>Family History</th>
                        <td>{!!  $patient->family_history ?? 'N/A' !!}</td>
                    </tr>
                    <tr>
                        <th>Social History</th>
                        <td>{!!  $patient->social_history ?? 'N/A' !!}</td>
                    </tr>
                    <tr>
                        <th>Vaccination History</th>
                        <td>{!!  $patient->vaccination_history ?? 'N/A' !!}</td>
                    </tr>
                    <tr>
                        <th>Disease History</th>
                        <td>{!!  $patient->disease_history ?? 'N/A' !!}</td>
                    </tr>
                    <tr>
                        <th>Past Treatments</th>
                        <td>{!!  $patient->past_treatments ?? 'N/A' !!}</td>
                    </tr>
                    <tr>
                        <th>Mental Health History</th>
                        <td>{!!  $patient->mental_health_history ?? 'N/A' !!}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
