<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\AuthorResource;
use App\Http\Resources\GenderResource;
use App\Http\Resources\ReviewResource;

class BookResource extends JsonResource
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
            'synopsis' => $this->synopsis,
            'gender_id' => $this->gender_id,
            'author_id' => $this->author_id,
            'gender' => new GenderResource($this->whenLoaded('gender')),
            'author' => new AuthorResource($this->whenLoaded('author')),
            'review' => ReviewResource::collection($this->whenLoaded('review')),
        ];
    }
}
