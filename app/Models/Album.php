<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = [
        'spotify_id',
        'name',
        'thumb_url',
        'release_date',
    ];
}
