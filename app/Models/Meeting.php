<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;


    protected $fillable = [
        'topic',
        'meeting_id',
        'doctor_id',
        'host_email',
        'join_url',
        'start_url',
        'duration',
        'start_time',
        'status',
    ];
}
