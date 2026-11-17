<?php

namespace App\Models\Clinic;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClinicSetting extends Model
{
    use HasFactory;


    protected $fillable = [
        'clinic_id', 'facebook', 'instagram', 'twitter', 'linkedin', 'youtube', 'website',
        'speciality', 'infrastructure', 'facility'
    ];

    // Define the relationship to the Hospital model (if necessary)
    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }
}
