<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    //
    protected $fillable = [
        'client_name',
        'event_type',
        'message',
        'rating',
        'is_active',
        'display_order',
    ];
}