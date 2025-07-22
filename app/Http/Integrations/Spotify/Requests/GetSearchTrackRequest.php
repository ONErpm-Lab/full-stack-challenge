<?php

namespace App\Http\Integrations\Spotify\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Http\Connector;
use Saloon\PaginationPlugin\OffsetPaginator;
use Saloon\PaginationPlugin\Contracts\Paginatable;
use Saloon\PaginationPlugin\Contracts\HasRequestPagination;
use App\Http\Integrations\Spotify\DTOs\TrackDTO;
use Illuminate\Support\Arr;

class GetSearchTrackRequest extends Request implements Paginatable, HasRequestPagination
{
    protected Method $method = Method::GET;

    public function resolveEndpoint(): string
    {
        return '/search';
    }

    protected function defaultQuery(): array
    {
        return [
            'type' => 'track',
            'include_external' => 'audio'
        ];
    }

    public function createDtoFromResponse(Response $response): array
    {
        return Arr::map(
            $response->json(key: 'tracks.items'),
            fn(array $item) => TrackDTO::from($item)
        );
    }

    public function paginate(Connector $connector): OffsetPaginator
    {
        return new class(
            connector: $connector,
            request: $this
        ) extends OffsetPaginator {
            protected ?int $perPageLimit = 50;

            protected function isLastPage(Response $response): bool
            {
                $total = (int)$response->json(key: 'tracks.total');
                return $this->getOffset() >= $total;
            }

            protected function getPageItems(Response $response, Request $request): array
            {
                return $response->dtoOrFail();
            }
        };
    }
}
