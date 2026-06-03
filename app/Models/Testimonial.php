<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
        protected $fillable = [
        'client_name',
        'company',
        'designation',
        'review',
        'rating',
        'image',
        'status',
    ];
}
