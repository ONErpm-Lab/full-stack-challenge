<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    protected $table = 'tracks';

    protected $fillable = ['isrc', 'thumb_url', 'release_date', 'title', 'length'];
}
