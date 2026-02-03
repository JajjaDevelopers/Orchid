<?php

/**
 * This File contains the blogs model and its
 * related relationships
 *
 * PHP version 8
 *
 * @category  Models
 * @package    App\Models
 * @author     Kibooli Felix <kiboolif@gmail.com>
 * @license  MIT (https://opensource.org/licenses/MIT)
 * @link       https://github.com/KIBOOLI-FELIX/mribrahimsite.git
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * This is a blog model class that
 * handles blog posts
 *
 * PHP version 8
 *
 * @category  Models
 * @package    App\Models
 * @author     Kibooli Felix <kiboolif@gmail.com>
 * @license  MIT (https://opensource.org/licenses/MIT)
 * @link       https://github.com/KIBOOLI-FELIX/mribrahimsite.git
 */
class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'user_id',
        'category_id',
        'content',
        'excerpt',
        'status',
        'image',
        'approved_by',
        'slug',
        'published_at'
    ];

     /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'tags' => 'array',
        ];
    }

    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<User, Blog>
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Automatic generation of slugs
     * @return void
     */
    public static function boot()
    {
        parent::boot();
        // Generate the slug only when creating a blog, not during updates
        static::creating(function ($blog) {
            // Generate a slug from the title
            $slug = Str::slug($blog->title);

            // Check if the slug already exists and append a unique identifier
            if (Blog::where('slug', $slug)->exists()) {
                $slug = $slug . '-' . uniqid();
            }

            $blog->slug = $slug;
        });
    }

    /**
     * Summary of category
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Category, Blog>
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * This retrieves all the images of a given post
     *
     * @return void
     */
    // public function images()
    // {
    //     return $this->hasMany(BlogImage::class);
    // }

    /**
     * Return comments for a particular Blog post
     *
     * @return void
     */
    public function comments()
    {
        return $this->hasMany(Comments::class);
    }
}
