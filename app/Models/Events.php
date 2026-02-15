<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    //
    protected $fillable = [
        'title', 'description', 'date', 'location', 'slug', 'image','start_time','end_time'
    ];

    /**
     * Automatic generation of slugs
     * @return void
     */
    public static function boot()
    {
        parent::boot();
        // Generate the slug only when creating a blog, not during updates
        static::creating(function ($event) {
            // Generate a slug from the title
            $slug = Str::slug($event->title);

            // Check if the slug already exists and append a unique identifier
            if (Events::where('slug', $slug)->exists()) {
                $slug = $slug . '-' . uniqid();
            }

            $event->slug = $slug;
        });
    }
}
