<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DocumentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $images = $this->image_urls ? explode(',', $this->image_urls) : [];
        $categoryIds = $this->category_ids ? explode(',', $this->category_ids) : [];
        $categoryNames = \App\Models\Category::whereIn('id', $categoryIds)->pluck('name');
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'file_url' => $this->file_path,
            'date' => $this->year,
            'summary' => $this->summary,
            'organization' => $this->organization,
            'video_url' => $this->video_url,
            'external_links' => $this->external_links ? json_decode($this->external_links, true) : [],
            //  'images' => $this->image_urls,
            // 'categories' => $this->category_ids,
            'images' => $images,
            'categories' => $categoryNames,
            'created_at' => $this->created_at->format('M d, Y h:i A'),
            'updated_at' => $this->updated_at->format('M d, Y h:i A'),
        ];
    }
}
