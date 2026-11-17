<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = ['clinic_id', 'title', 'image'];

    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }
}
