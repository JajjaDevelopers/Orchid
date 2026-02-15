<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject',
        'attachments',
        'content',
        'video_urls',
        'scheduled_at',
        'is_sent'
    ];
    protected $casts = [
        'scheduled_at' => 'datetime',
        // 'attachments' => 'array',
        // 'video_urls'=>'array',
    ];
}
