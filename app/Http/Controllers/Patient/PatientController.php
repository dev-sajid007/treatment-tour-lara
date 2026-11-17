<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient\PatientHistory;
use Auth;

class PatientController extends Controller
{
   public function myHistory()
   {
      $patient = PatientHistory::where('patient_id', auth()->user()->id)->first();
      $user = Auth::user();

      return view('patient.patient_histories.my_history', compact('patient', 'user'));
   }
}
