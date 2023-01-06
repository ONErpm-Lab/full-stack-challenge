<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Track extends Model
{
    use SoftDeletes;

    protected $table = 'tracks';

    protected $fillable = ['isrc', 'thumb_url', 'release_date', 'title', 'length', 'spotify_url', 'br_avaiable'];

    public function set($data)
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }

    public function artists()
    {
        return $this->belongsToMany(Artist::class);
    }
}
