<?php

namespace App\Repositories;

use App\Entities\Entity;
use App\Repositories\Contracts\RepositoryInterface;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

abstract class Repository implements RepositoryInterface
{
    protected string $table;

    public function __construct(string $table)
    {
        $this->table = $table;
        $this->query();
    }

    public function __invoke()
    {
        $this->query();
    }

    public function query(bool $includeAlias = true): Builder
    {
        $alias = $includeAlias ? strtoupper(substr($this->table, 0, 1)) : null;
        return DB::table($this->table, $alias);
    }

    public function fromId($id): object
    {
        $clause = is_array($id) ? $id : ['id' => $id];
        return $this->query()->where($clause)->get()->first();
    }

    public function delete(int $id)
    {
        $this->query()->delete($id);
    }

    public function insert(array|Entity $data): array
    {
        if ($data instanceof Entity) $data = $data->toArray();
        $filteredData = $this->filterDataInsert($data);
        $id = $this->query(false)->insertGetId($filteredData);
        $data['id'] = $id;
        return $data;
    }
    
    public function update(Entity $entity): Entity
    {
        $id = $entity->id();
        $this->query()->where('id', '=', $id)->update($entity->toArray());
        return $entity;
    }

    public function getAll()
    {
        return $this->query()->get();
    }

    private function filterDataInsert(array $data)
    {
        return array_filter($data, fn ($item) => !is_array($item) && !empty($item) && !$item instanceof Entity);
    }
}