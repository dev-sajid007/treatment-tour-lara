<?php

namespace App\Models\Doctor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class DoctorSlot extends Model
{
    use HasFactory;

     protected $fillable = [
        'doctor_id',
        'day_of_week',
        'start_time',
        'end_time',
        'max_patients',
        'status',
    ];


    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }





}
