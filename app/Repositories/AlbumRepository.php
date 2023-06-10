<?php

namespace App\Repositories;

class AlbumRepository extends Repository
{
    public function __construct()
    {
        parent::__construct('albums');
    }

    public function getByTitle(string $title)
    {
        return $this->query()->where(['title' => $title])->get();
    }
}
