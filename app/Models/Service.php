<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
     protected $fillable = [
        'category_id',
        'title',
        'slug',
        'icon',
        'short_description',
        'description',
        'featured_image',
        'is_featured',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
