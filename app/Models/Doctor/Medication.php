<?php

namespace App\Models\Doctor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Doctor\Prescription;

class Medication extends Model
{
    use HasFactory;


    protected $fillable = [
        'prescription_id',
        'name',
        'dosage',
        'frequency',

    ];

    public function prescription()
    {
        return $this->hasMany(Prescription::class, 'prescription_id', 'id');
    }
}
