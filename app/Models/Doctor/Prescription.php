<?php

namespace App\Models\Doctor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Doctor\Medication;

class Prescription extends Model
{
    use HasFactory;

    public function medications()
    {
        return $this->hasMany(Medication::class, 'prescription_id', 'id');
    }
}
