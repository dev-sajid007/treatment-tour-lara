<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    protected $fillable = ['clinic_id', 'name', 'procedure', 'price', 'duration'];

    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }
}
