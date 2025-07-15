<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    protected $fillable = [
        'spotify_id',
        'spotify_url',
        'name',
    ];
}
