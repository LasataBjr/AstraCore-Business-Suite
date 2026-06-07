<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
    
    //Auto slug generation prevents duplicates slugs
    protected static function boot()
    {
        parent::boot();

        // Create slug when creating
        static::creating(function ($service) {
            if (empty($service->slug)) {
                $service->slug = static::generateUniqueSlug($service->title);
            }
        });

        // Update slug when title changes
        static::updating(function ($service) {
            if ($service->isDirty('title')) {
                $service->slug = static::generateUniqueSlug(
                    $service->title,
                    $service->id
                );
            }
        });
    }

    protected static function generateUniqueSlug($title, $ignoreId = null)
    {
        $slug = Str::slug($title); // Generate initial slug
        $originalSlug = $slug; 

        $count = 1;

        while (
            static::where('slug', $slug) // Check if slug exists
                ->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))// Exclude current record when updating
                ->exists()
        ) {
            $slug = $originalSlug . '-' . $count++; // Append count to slug until unique
        }

        return $slug;
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
