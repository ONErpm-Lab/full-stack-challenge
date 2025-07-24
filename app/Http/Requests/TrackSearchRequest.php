<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TrackSearchRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'per_page'            => 'integer|min:1|max:100',
            'page'                => 'integer|min:1',
            'sort'                => ['string', Rule::in(['name', 'created_at', 'release_date'])],
            'direction'           => ['string', Rule::in(['asc', 'desc'])],
            'search'              => 'string|max:255',
            'available_in_brazil' => 'boolean',
            'artist'              => 'string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'per_page.max' => __('Maximum of 100 items per page allowed.'),
            'sort.in'      => __('Sort field must be one of: name, created_at, release_date.'),
            'direction.in' => __('Direction must be either asc or desc.'),
            'search.max'   => __('Search term cannot exceed 255 characters.'),
            'artist.max'   => __('Artist name cannot exceed 255 characters.'),
        ];
    }

    public function getPerPage(): int
    {
        return $this->validated('per_page', 15);
    }

    public function getSort(): string
    {
        return $this->validated('sort', 'name');
    }

    public function getDirection(): string
    {
        return $this->validated('direction', 'asc');
    }

    public function getSearch(): ?string
    {
        return $this->validated('search');
    }

    public function getAvailableInBrazil(): ?bool
    {
        return $this->validated('available_in_brazil');
    }

    public function getArtist(): ?string
    {
        return $this->validated('artist');
    }
}
