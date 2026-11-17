<?php

namespace App\Models\Patient;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class PatientAppointment extends Model
{
    use HasFactory;


      protected $fillable = [
        'doctor_id',
        'clinic_id',
        'hospital_id',
        'patient_id',
        'appointment_date',
        'appointment_time',
        'reason',
    ];


    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id', 'id');
    }


    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id', 'id');
    }
}
