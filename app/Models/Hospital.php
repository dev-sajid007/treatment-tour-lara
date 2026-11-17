<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'image',
        'name',
        'address',
        'country_id',
        'city_id',
        'established',
        'no_of_beds',
        'speciality_type',
        'description'
    ];

    // Relationships
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function state_city()
    {
        return $this->belongsTo(State::class, 'city_id');
    }

}