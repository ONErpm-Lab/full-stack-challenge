<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artist extends Model
{
    use SoftDeletes;

    protected $table = 'artists';

    protected $fillable = ['spotify_id', 'name'];

    public function set($data)
    {
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }

    public function artists()
    {
        return $this->belongsToMany(Track::class);
    }
}