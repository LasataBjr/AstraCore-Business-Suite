<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
     protected $fillable = [
        'name',
        'designation',
        'bio',
        'image',
        'facebook',
        'linkedin',
        'sort_order',
        'status',
    ];
}
