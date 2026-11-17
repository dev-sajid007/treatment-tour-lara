<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $fillable = ['country_id', 'name', 'details'];

    // A State belongs to a Country
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
