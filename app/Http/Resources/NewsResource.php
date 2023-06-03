<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        return [
            'id' => (string)$this->id,
            'title' => $this->title,
            'category' => $this->category,
            'description' => $this->description,
            'image' => $this->image,
            'created_at' => $this->created_at,
        ];
    }
}
