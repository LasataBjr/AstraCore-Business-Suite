<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
      protected $fillable = [
        'site_name',
        'tagline',
        'email',
        'phone',
        'address',
        'logo',
        'favicon',
        'facebook',
        'linkedin',
        'instagram',
        'footer_text',
    ];
}
