<?php

namespace App\Entities;

use App\Repositories\ArtistRepository;

class Artist extends Entity
{

    public function __construct(
        public string $name,
        int $id = null
    )
    {
        $this->id = $id;
    }

    public static function fromName(string $name)
    {
        $artist = (new ArtistRepository)->getByName($name)->first() ?? null;
        return empty($artist) ? (new self($name))->save() : self::fromObject($artist);
    }

    public function save()
    {
        return self::fromArray((new ArtistRepository)->insert($this));
    }

    public static function fromObject(object $object)
    {
        return new self(
            name: $object->name,
            id: $object->id ?? null
        );
    }

    public static function get($artist)
    {
        return $artist instanceof self
            ? $artist 
            : (is_string($artist) 
                ? self::fromName($artist)
                : (is_array($artist) 
                    ? self::fromArray($artist) 
                    : self::fromObject($artist)
                )
            );
    }
}
