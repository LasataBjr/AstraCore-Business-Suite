<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
   //use HasFactory; 

    protected $fillable = [
        'name',
        'slug',
        'description',
        'status',
    ];

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
