<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['clinic_id', 'name', 'date', 'review', 'rating'];

    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }
}
