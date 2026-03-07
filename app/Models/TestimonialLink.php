<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestimonialLink extends Model
{
    //
     protected $fillable = [
        'token',
        'is_active',
        'expires_at',
    ];
}
