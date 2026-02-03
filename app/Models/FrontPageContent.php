<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FrontPageContent extends Model
{
    protected $fillable = [
        'carousel_images',
        'title',
        'description',
        'file_path',
    ];

    protected $casts = [
        'carousel_images' => 'array',
    ];

    /**
     * Accessor to get individual images as array even if stored comma-separated
     */
    public function getCarouselArrayAttribute()
    {
        if (is_array($this->carousel_images)) {
            return $this->carousel_images;
        }

        return $this->carousel_images
            ? explode(',', $this->carousel_images)
            : [];
    }
}
