<?php

namespace App\Models\Patient;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class PatientHistory extends Model
{
    use HasFactory;


protected $fillable = [
    'patient_id',
    'guardian_name',
    'guardian_relationship',
    'guardian_contact_number',
    'guardian_email',
    'medical_conditions',
    'medications',
    'allergies',
    'surgical_history',
    'family_history',
    'social_history',
    'vaccination_history',
    'disease_history',
    'past_treatments',
    'mental_health_history',
];



    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id', 'id');
    }


}
