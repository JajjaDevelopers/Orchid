<?php

/**
 * This is a blog image model file that
 * handles multiple images for a given blog post
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

/**
 * This is a blog Image model class that
 * handles multiple images for a given post
 *
 * PHP version 8
 *
 * @category  Models
 * @package    App\Models
 * @author     Kibooli Felix <kiboolif@gmail.com>
 * @license  MIT (https://opensource.org/licenses/MIT)
 * @link       https://github.com/KIBOOLI-FELIX/mribrahimsite.git
 */
class BlogImage extends Model
{
    use HasFactory;

    protected $fillable = ['blog_id', 'image_path'];

    /**
     * This function retrieves all images for a given blog post
     *
     * @return void
     */
    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}
