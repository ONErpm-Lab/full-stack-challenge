<?php

namespace App\Entities;

use App\Repositories\TrackRepository;

class Track extends Entity
{
    public array $artists;
    public Album $album;

    public function __construct(
        public string $isrc,
        public string $title,
        public int $duration,
        array $album,
        array $artists,
        public string $external_url,
        public bool $br_enabled,
        public string $preview_url,
        int $id = null
    )
    {
        $this->album = Album::fromArray($album);
        $this->artists = array_map(fn ($artist) => Artist::get($artist), $artists);
        $this->id = $id;
    }

    public function save()
    {
        return (new TrackRepository)->save($this);
    }

    public static function fromObject(object $object)
    {
        return new self(
            isrc: $object->isrc,
            title: $object->title,
            duration: $object->duration,
            album: $object->album,
            artists: $object->artists,
            external_url: $object->external_url,
            br_enabled: $object->br_enabled,
            preview_url: $object->preview_url,
            id: $object->id ?? null
        );
    }
}
