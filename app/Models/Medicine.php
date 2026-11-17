<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 
use App\Models\Admin\MedCategory;

class Medicine extends Model
{
    use HasFactory;



    protected $fillable = ['name', 'trade_name', 'dosage', 'description', 'manufacturer', 'med_category_id'];

    
    public function category()
    {
        return $this->belongsTo(MedCategory::class, 'med_category_id');
    }

    
}
