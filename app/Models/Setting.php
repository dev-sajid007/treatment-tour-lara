<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'website_name',
        'business_email',
        'business_phone',
        'logo',
        'favicon',
        'attend_delay',
        'currency',
        'cut_persent',
        'address',
        'company_foundation_year',
    ];
}
