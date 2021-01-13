<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Song extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'isrc' => $this->isrc,
            'release_date' => $this->release_date,
            'title' => $this->title,
            'duration' => $this->duration,
            'preview_link' => $this->preview_link,
            'spotify_link' => $this->spotify_link,
            'brasil_available' => $this->brasil_available,
            'artists' => $this->artists()->toArray(),
        ];
    }
}
