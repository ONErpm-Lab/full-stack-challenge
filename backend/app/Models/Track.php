<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    protected $table = 'tracks';

    protected $fillable = ['isrc', 'thumb_url', 'release_date', 'title', 'length'];

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
