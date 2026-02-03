<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
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
            'excerpt' => strip_tags($this->excerpt),
            'content' => strip_tags($this->content),
            'author' => $this->user->first_name . ' ' . $this->user->last_name,
            'category' => $this->category->name,
            'slug' => $this->slug,
            'image_url' => $this->image ? asset($this->image) : $this->image,
            'published_at' => $this->created_at->format('M d, Y h:i A'),
            'updated_at' => Carbon::parse($this->updated_at)->format('M d, Y'),
        ];
    }
}
