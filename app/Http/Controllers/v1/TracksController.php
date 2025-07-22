<?php

namespace App\Http\Controllers\v1;

use OpenApi\Attributes as OA;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\TrackService;
use App\DTOs\Track\TrackDTO;

#[OA\Tag('Track')]
class TracksController extends Controller
{
    public function __construct(private readonly TrackService $trackService) {}

    #[OA\Get(path: '/v1/tracks', tags: ['Track'], security: [['ApiToken' => []]])]
    #[OA\QueryParameter(name: 'page')]
    #[OA\QueryParameter(name: 'limit')]
    #[OA\QueryParameter(name: 'q', description: 'search')]
    #[OA\Response(
        response: 200,
        description: '',
        content: new OA\JsonContent(
            type: 'object',
            required: ['data'],
            properties: [
                new OA\Property(
                    property: 'data',
                    type: 'array',
                    items: new OA\Items(ref: TrackDTO::class)
                ),
            ]
        )
    )]
    public function index(Request $request)
    {
        return $this->trackService->paginate(
            page: $request->page,
            perPage: $request->limit,
            search: $request->q,
        );
    }
}
