<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TrackSearchRequest;
use App\Http\Resources\TrackResource;
use App\Models\Track;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TracksController extends Controller
{
    public function index(TrackSearchRequest $request): AnonymousResourceCollection
    {
        $tracks = Track::query()->with([
            'album',
            'artists',
        ]);

        if ($search = $request->getSearch()) {
            $tracks->where(function (Builder $query) use ($search) {
                $query->whereLike('name', "%{$search}%")
                    ->orWhereLike('isrc', "%{$search}%");
            });
        }

        if ($availableInBrazil = $request->getAvailableInBrazil()) {
            $tracks->where('available_in_br', $availableInBrazil);
        }

        if ($artist = $request->getArtist()) {
            $tracks->whereHas('artists', function (Builder $query) use ($artist) {
                $query->where('name', 'like', "%{$artist}%");
            });
        }

        $tracks->orderBy($request->getSort(), $request->getDirection());

        $tracks = $tracks->paginate($request->getPerPage())->appends([
            'search'          => $search,
            'available_in_br' => $availableInBrazil,
            'artist'          => $artist,
            'sort'            => $request->getSort(),
            'direction'       => $request->getDirection(),
            'per_page'        => $request->getPerPage(),
        ]);

        return TrackResource::collection($tracks);
    }

    public function show(Track $track): TrackResource
    {
        $track->loadMissing([
            'album',
            'artists',
        ]);

        return new TrackResource($track);
    }
}
