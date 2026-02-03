<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SermonResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => strip_tags($this->description),
            'preacher' => $this->preacher,
            'scripture_reference' => $this->scripture_reference,
            'preached_on' => Carbon::parse($this->preached_on)->format('M d, Y'),
            'audio_url' => $this->audio_url,
            'video_url' => $this->video_url,
            'image_url' => $this->image_url ? asset($this->image_url) : $this->image_url,
            // 'created_at' => $this->created_at->toDateTimeString(),
            // 'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
