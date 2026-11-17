<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor\Prescription;
use App\Models\Doctor\Medication;
use App\Models\User;
use App\Models\Patient\PatientAppointment;
use App\Models\Patient\PatientHistory;
use Barryvdh\DomPDF\Facade\Pdf; 
use App\Models\Doctor\DoctorProfile;
use App\Models\MedicalReport;
use Auth;
class PrescriptionController extends Controller
{

    public function index()
    {
       
    }


    public function create(Request $request, $doctor, $patient, $appointment)
    {
        $patientUser = User::findOrFail($patient);
        $appointment_info = PatientAppointment::findOrFail($appointment);
        $patientHistory = PatientHistory::where('patient_id', $patientUser->id)->first();
        $reports = MedicalReport::where('user_id', $patientUser->id)->get();
        return view('doctor.prescriptions.create', compact('doctor', 'patientUser', 'appointment_info', 'patientHistory', 'patient', 'appointment', 'reports'));
    }

    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            // 'date' => 'required|date',
            // 'appointment_id' => 'required|exists:patient_appointments,id',
            // 'symptoms' => 'nullable|string',
            // 'tests' => 'nullable|string',
            // 'diagnosis' => 'nullable|string',
            // 'notes' => 'nullable|string',
            // 'medications.*.dosage' => 'required_with:medications|string',
            // 'medications.*.frequency' => 'required_with:medications|string',
        ]);

        $patient = User::findOrFail($request->patient_id);

        // Store prescription
        $prescription = new Prescription();
        $prescription->appointment_id = $request->appointment_id;
        $prescription->patient_id = $patient->id ;
        $prescription->doctor_id = auth::user()->id;
        $prescription->date = $request->date;
        $prescription->symptoms = $request->symptoms;
        $prescription->tests = $request->tests;
        $prescription->diagnosis = $request->diagnosis;
        $prescription->notes = $request->notes;
        $prescription->save();

        // Store medications
        if ($request->has('medications')) {
            foreach ($request->medications as $medication) {
                Medication::create([
                    'prescription_id' => $prescription->id,
                    'name' => $medication['name'] ?? null,
                    'dosage' => $medication['dosage'],
                    'frequency' => $medication['frequency'],
                ]);
            }
        }

        // Generate PDF
        $medications = Medication::where('prescription_id', $prescription->id)->get();
        $doctorProfile = DoctorProfile::where('user_id', $prescription->doctor_id)->first();
        $doctor = User::with('doctor')->findOrFail($prescription->doctor_id);
        $patient_info = PatientHistory::where('patient_id', $prescription->patient_id)->first();
        $pdf = Pdf::loadView('doctor.prescriptions.pdf', [
            'prescription' => $prescription,
            'medications' => $medications,
            'patient' => $patient,
            'doctorProfile' => $doctorProfile,
            'patient_info' => $patient_info,
            'doctor' => $doctor
        ]);

        // Stream PDF in the browser
        return $pdf->stream('prescription.pdf');
    }


    public function show(string $id)
    {
        
    }

    public function edit($prescriptionId, $doctorId, $patientId, $appointmentId)
    {
        $prescription = Prescription::with('medications')->findOrFail($prescriptionId);
        $appointment_info = PatientAppointment::findOrFail($appointmentId);
        $patientUser = User::findOrFail($patientId);
        $patientHistory = PatientHistory::where('patient_id', $patientId)->first();

       //$medications = Medication::where('prescription_id', $prescription->id )->get();

       //dd($medications);

        // foreach($medications as $med){
        //     dd($med->name);
        // }


        return view('doctor.prescriptions.edit', compact(
            'prescription',
            'doctorId',
            'patientUser',
            'appointmentId',
            'appointment_info',
            'patientHistory'
        ));
    }




    public function update(Request $request, $id)
    {
        $request->validate([
            // 'date' => 'required|date',
            // 'symptoms' => 'nullable|string',
            // 'tests' => 'nullable|string',
            // 'diagnosis' => 'nullable|string',
            // 'notes' => 'nullable|string',
            // 'medications.*.dosage' => 'required_with:medications|string',
            // 'medications.*.frequency' => 'required_with:medications|string',
        ]);

        $prescription = Prescription::findOrFail($id);
        $prescription->date = $request->date;
        $prescription->symptoms = $request->symptoms;
        $prescription->tests = $request->tests;
        $prescription->diagnosis = $request->diagnosis;
        $prescription->notes = $request->notes;
        $prescription->save();

        // Delete old medications and insert new ones
        Medication::where('prescription_id', $prescription->id)->delete();

        if ($request->has('medications')) {
            foreach ($request->medications as $medication) {
                Medication::create([
                    'prescription_id' => $prescription->id,
                    'name' => $medication['name'] ?? null,
                    'dosage' => $medication['dosage'],
                    'frequency' => $medication['frequency'],
                ]);
            }
        }

        // Generate PDF
        $patient = User::findOrFail($prescription->patient_id);
        $doctor = User::with('doctor')->findOrFail($prescription->doctor_id);
        $medications = Medication::where('prescription_id', $prescription->id)->get();
        $doctorProfile = DoctorProfile::where('user_id', $doctor->id)->first();
        $patient_info = PatientHistory::where('patient_id', $patient->id)->first();

        $pdf = Pdf::loadView('doctor.prescriptions.pdf', [
            'prescription' => $prescription,
            'medications' => $medications,
            'patient' => $patient,
            'doctor' => $doctor,
            'doctorProfile' => $doctorProfile,
            'patient_info' => $patient_info
        ]);

        // Stream PDF in the browser
        return $pdf->stream('prescription.pdf');
    }


    public function download($id)
    {
        $prescription = Prescription::findOrFail($id);
        $patient = User::findOrFail($prescription->patient_id);
        $doctor = User::with('doctor')->findOrFail($prescription->doctor_id);
        $medications = Medication::where('prescription_id', $prescription->id)->get();
        $doctorProfile = DoctorProfile::where('user_id', $doctor->id)->first();
        $patient_info = PatientHistory::where('patient_id', $patient->id)->first();
     

        $pdf = Pdf::loadView('doctor.prescriptions.pdf', [
            'prescription' => $prescription,
            'medications' => $medications,
            'patient' => $patient,
            'doctor' => $doctor,
            'doctorProfile' => $doctorProfile,
            'patient_info' => $patient_info
        ]);

        //return $pdf->download('prescription_' . $prescription->id . '.pdf');
        return $pdf->stream('prescription_' . $prescription->id . '.pdf');
    }




    public function destroy(string $id)
    {
        
    }
}
