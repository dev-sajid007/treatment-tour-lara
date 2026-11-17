<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'email', 'description', 'address', 'main_image', 'gallery_images', 'map_embed_code', 'country_id', 'state_id'];

    // Handle gallery_images as an array (JSON)
    protected $casts = [
        'gallery_images' => 'array',
    ];

    // Relationships
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'clinic_category');
    }

    public function subcategories()
    {
        return $this->belongsToMany(SubCategory::class, 'clinic_subcategory', 'clinic_id', 'subcategory_id');
    }

    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }

    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }


    public function specialities()
    {
        return $this->belongsToMany(Speciality::class, 'clinic_speciality');
    }


}
