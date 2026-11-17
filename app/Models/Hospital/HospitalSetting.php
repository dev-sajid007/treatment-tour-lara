<?php

namespace App\Models\Hospital;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HospitalSetting extends Model
{
    use HasFactory;


    protected $fillable = [
        'hospital_id', 'facebook', 'instagram', 'twitter', 'linkedin', 'youtube', 'website',
        'speciality', 'infrastructure', 'facility'
    ];

    // Define the relationship to the Hospital model (if necessary)
    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }
}
