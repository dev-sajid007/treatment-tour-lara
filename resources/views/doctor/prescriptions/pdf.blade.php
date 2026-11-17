<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prescription</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
        }
        .header .sub-info {
            font-size: 14px;
        }
        .info-table, .medicine-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .info-table td, .medicine-table th, .medicine-table td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        .info-table td {
            font-size: 14px;
        }
        .section-title {
            font-weight: bold;
            margin-top: 20px;
        }
        .advice {
            margin-top: 20px;
            font-size: 14px;
        }
        .advice ul {
            padding-left: 20px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>{{ $doctor->name ?? 'Your Doctor' }}</h1>
        <p class="sub-info">{{$doctorProfile->qualification ?? ''}} | Reg. No: {{ $doctorProfile->license_number ?? '' }}</p>
        <p class="sub-info">
           <span style="font-size: 18px; margin-bottom: 20px;">Treatment Tour</span> <br>
            Phone: {{ $setting->business_phone ?? '' }}, Email: {{ $setting->business_email ?? '' }}<br>
            
        </p>
    </div>

    <!-- Patient Info -->
    <table class="info-table">
        <tr>
            <td><strong>ID:</strong> {{ $patient->serial ?? '' }}</td>
            <td><strong>Date:</strong> {{ $prescription->date }}</td>
        </tr>
        <tr>
            <td><strong>Patient:</strong> {{ $patient->name }} ({{ $patient->gender }}  {{ \Carbon\Carbon::parse($patient->date_of_birth)->age ?? '' }} years)</td>
            <td><strong>Mob. No:</strong> {{ $patient->phone }}</td>
        </tr>
        {{--
        <tr>
            <td><strong>Address:</strong> {{ $patient->address }}</td>
            <td><strong>Weight (Kg):</strong> {{ $patient->weight }} | <strong>B.P:</strong> {{ $patient->blood_pressure }}</td>
        </tr>
        --}}
    </table>

    <!-- Chief Complaints and Clinical Findings -->
    <div class="section-title">Chief Complaints</div>
    <p>{!! $prescription->symptoms ?? 'Not provided' !!}</p>

    <div class="section-title">Clinical Findings</div>
    <p>{!!  $prescription->clinical_findings ?? 'Not provided' !!}</p>

    <!-- Diagnosis -->
    <div class="section-title">Diagnosis</div>
    <p>{!!  $prescription->diagnosis ?? 'Not provided' !!}</p>

    <!-- Medication Table -->
    <div class="section-title">Medications</div>
    @if(count($medications) > 0)
    <table class="medicine-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Medicine Name</th>
                <th>Dosage</th>
                <th>Duration</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($medications as $index => $medication)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $medication->name }}</td>
                    <td>{{ $medication->dosage }}</td>
                    <td>{{ $medication->frequency }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else

    <p>No medication provided by Doctor</p>

    @endif
    <div class="advice">
        <strong>Advice: {{$prescription->note}}</strong>
        <span></span>

    </div> 



    <!-- Advice -->
<!--     <div class="advice">
        <strong>Advice:</strong>
        <ul>
            <li>Take bed rest</li>
            <li>Do not eat outside food</li>
            <li>Eat easy-to-digest food like boiled rice with daal</li>
        </ul>
    </div> -->

    <!-- Follow Up -->
    <!-- <p><strong>Follow Up:</strong> {{ $prescription->follow_up_date ?? 'Not provided' }}</p> -->

    <footer>
        <p>Substitute with equivalent Generics as required.</p>
    </footer>
</body>
</html>
