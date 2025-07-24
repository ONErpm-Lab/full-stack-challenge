<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AlbumResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'spotify_id'   => $this->spotify_id,
            'name'         => $this->name,
            'release_date' => $this->release_date_formatted,
            'thumb_url'    => $this->thumb_url,
            'spotify_url'  => $this->spotify_url,
            'created_at'   => $this->created_at?->toISOString(),
            'updated_at'   => $this->updated_at?->toISOString(),
        ];
    }
}
