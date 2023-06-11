<?php

namespace App\Repositories;

class ArtistRepository extends Repository
{
    public function __construct()
    {
        parent::__construct('artists');
    }

    public function getByName(string $name)
    {
        return $this->query()->where(['name' => $name])->get();
    }
}
