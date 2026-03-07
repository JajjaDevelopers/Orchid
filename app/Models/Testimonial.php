<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    //
    protected $fillable = [
        'client_name',
        'client_photo',
        'phone_contact',
        'event_type',
        'message',
        'rating',
        'is_active',
        'display_order',
    ];
}