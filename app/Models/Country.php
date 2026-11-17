<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'details'];

    // A Country has many States
    public function states()
    {
        return $this->hasMany(State::class);
    }
}
