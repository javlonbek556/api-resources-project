<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\BookResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'bio'=> $this->bio,
            'books' => BookResource::collection($this->whenLoaded('books')),
        ];
    }
    
}
