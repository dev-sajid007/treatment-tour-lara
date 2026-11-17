<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = ['clinic_id', 'title', 'description', 'file_path'];

    public function clinic()
    {
        return $this->belongsTo(Clinic::class);
    }
}
