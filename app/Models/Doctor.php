<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

  protected $fillable = [
    'user_id',
    'specialization',
    'medical_license_number',
    'certifications',
    'clinic_name',
    'consultation_fee',
    'available_countries',
    'treatment_provided',
    'conditions_treated',
    'procedures_performed',
    'available_days',
    'available_time_slots',
    'clinic_address',
    'city',
    'state',
    'postal_code',
    'consultation_type',
    'experience_years',
    'spoken_languages',
    'associations',
    'education' 
];


    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }
     public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    

    
}
