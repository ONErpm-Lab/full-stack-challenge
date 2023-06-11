<?php

namespace App\Entities;

use App\Repositories\AlbumRepository;

class Album extends Entity
{
    public array $artists;

    public function __construct(
        public string $title,
        public string $cover,
        public string $release_date,
        public ?string $external_url,
        array $artists,
        int $id = null
    )
    {
        $this->artists = array_map(fn ($artist) => Artist::get($artist), $artists);
        $this->id = $id;
    }

    public static function fromTitle(string $title)
    {
        return (new AlbumRepository)->getByTitle($title)->first() ?? null;
    }

    public static function fromObject(object $object)
    {
        return new self(
            title: $object->title,
            cover: $object->cover,
            release_date: $object->release_date,
            external_url: $object->external_url ?? null,
            artists: $object->artists,
            id: $object->id ?? null
        );
    }

    public static function get($artist)
    {
        return $artist instanceof self
            ? $artist 
            : (is_string($artist) 
                ? self::fromTitle($artist)
                : (is_array($artist) 
                    ? self::fromArray($artist) 
                    : self::fromObject($artist)
                )
            );
    }

    public function save()
    {
        $data = (new AlbumRepository)->insert($this);
        $this->id = $data['id'];
        return $this;
    }
}
