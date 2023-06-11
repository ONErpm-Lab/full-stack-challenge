<?php

namespace App\Repositories\Contracts;

use App\Entities\Entity;
use Illuminate\Contracts\Database\Query\Builder;

interface RepositoryInterface
{
    public function fromId(int $id): object;

    public function insert(array|Entity $data);

    public function update(Entity $entity);

    public function getAll();

    public function delete(int $id); 

    public function query(): Builder;
}