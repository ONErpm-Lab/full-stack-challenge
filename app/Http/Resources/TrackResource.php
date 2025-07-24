<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TrackResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                  => $this->id,
            'isrc'                => $this->isrc,
            'spotify_id'          => $this->spotify_id,
            'name'                => $this->name,
            'duration'            => $this->duration,
            'duration_ms'         => $this->duration_ms,
            'preview_url'         => $this->preview_url,
            'spotify_url'         => $this->spotify_url,
            'thumb_url'           => $this->thumb_url,
            'available_in_brazil' => $this->available_in_br,
            'created_at'          => $this->created_at?->toISOString(),
            'updated_at'          => $this->updated_at?->toISOString(),
            'album'               => new AlbumResource($this->whenLoaded('album')),
            'artists'             => ArtistResource::collection($this->whenLoaded('artists')),
        ];
    }
}
