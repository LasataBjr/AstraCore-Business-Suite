<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'published_at',
        'status',        
        'meta_title',
        'meta_description',        
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

     public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
