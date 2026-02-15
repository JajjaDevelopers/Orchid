<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sermons extends Model
{
   /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
       */
       protected $fillable = [
       'title',
       'description',
       'preacher',
       'preached_on',
       'audio_url',
       'video_url',
       'image_url',
       'scripture_reference',
       ];
}
