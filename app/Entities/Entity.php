<?php

namespace App\Entities;

use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Contracts\Support\Arrayable;

abstract class Entity implements Arrayable
{
    protected ?int $id;

    public function id(): ?int
    {
        return $this->id;
    }

    public function toArray(): array
    {
        return json_decode(json_encode($this), true);
    }

    public static function fromId($id, RepositoryInterface $repository)
    {
        $data = $repository->fromId($id);
        return self::fromObject($data);
    }

    public static function fromArray(array $data)
    {
        $entityCalled = get_called_class();
        return $entityCalled::fromObject((object) $data);
    }

    public static function fromJson(string $json)
    {
        return self::fromArray(json_decode($json, true));
    }

    abstract public static function fromObject(object $object);
}
