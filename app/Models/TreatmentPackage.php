<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TreatmentPackage extends Model
{
    use HasFactory;


    protected $fillable = ['package_name', 'treatment_category_id', 'image', 'country_id', 'description', 'price', 'status', 'hospital_id'];

    public function category()
    {
        return $this->belongsTo(TreatmentCategory::class, 'treatment_category_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
}
