<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = [
    'user_id',
    'date_of_birth',
    'gender',
    'age',
    'marital_status',  
    'occupation',
    'primary_contact',
    'address',
    'city',
    'state',
    'postal_code',
    'emergency_contact_name',
    'emergency_contact_relationship',
    'emergency_contact_number',
    'medical_conditions',
    'surgeries',
    'medications',
    'allergies',
    'current_health_issues',
    'duration_of_issue',
    'pain_description',
    'additional_symptoms',
    'report'
    
];
  public function user()
    {
        return $this->belongsTo(User::class);
    }
}
