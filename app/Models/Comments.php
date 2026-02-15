<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $fillable = [
        'blog_id', 'content', 'name', 'email',
    ];
    /**
     * Return a blog post to which comment belongs to
     *
     * @return void
     */
    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}
