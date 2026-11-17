<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;
    protected $fillable = [
                 'menu_id', 
                 'name', 
                 'slug', 
                 'type', 
                 'url', 
                 'is_visible', 
                 'parent', 
                 'icon', 
                 'image',
                 'levels',
                 'sort'

    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function parentItem()
    {
        return $this->belongsTo(MenuItem::class, 'parent');
    }

    public function childItems()
    {
        return $this->hasMany(MenuItem::class, 'parent');
    }
}
