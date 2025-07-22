<?php

namespace App\Services;

use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Builder;
use App\DTOs\Track\TrackDTO;
use App\Models\Track;

class TrackService
{
    public function paginate(
        ?int $page = 1,
        ?int $perPage = 15,
        ?string $search = null
    ) {
        /** @var Builder|QueryBuilder $builder */
        $builder = Track::query();
        $builder->orderBy('name');
        $builder->with(['artists', 'images']);
        $builder->when(!!$search, function (Builder $query) use ($search) {
            $query->whereLike('name', "%$search%");
        });

        $items = $builder->paginate(
            perPage: $perPage,
            page: $page
        );

        return TrackDTO::collect($items);
    }
}
